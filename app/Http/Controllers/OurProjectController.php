<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OurProjectController extends Controller
{
    public function index()
    {
        $projects = DB::table('our_projects')
            ->orderByDesc('id')
            ->get();

        return view('ourproject', compact('projects'));
    }

    public function create()
    {
        return redirect()->route('our-projects.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'project_name' => $validated['project_name'],
            'description' => $validated['description'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('projects', 'public');
        }

        DB::table('our_projects')->insert(array_merge($data, [
            'created_at' => now(),
            'updated_at' => now(),
        ]));

        return redirect()
            ->route('our-projects.index')
            ->with('success', 'Project added successfully.');
    }

    public function edit($id)
    {
        $project = DB::table('our_projects')->where('id', $id)->first();

        if (!$project) {
            return redirect()->route('our-projects.index')
                ->with('error', 'Project not found.');
        }

        $projects = DB::table('our_projects')
            ->orderByDesc('id')
            ->get();

        return view('ourproject', [
            'projects' => $projects,
            'editProject' => $project,
        ]);
    }

    public function update(Request $request, $id)
    {
        $project = DB::table('our_projects')->where('id', $id)->first();

        if (!$project) {
            return redirect()->route('our-projects.index')
                ->with('error', 'Project not found.');
        }

        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'project_name' => $validated['project_name'],
            'description' => $validated['description'] ?? null,
            'updated_at' => now(),
        ];

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }

            $data['image'] = $request->file('image')
                ->store('projects', 'public');
        }

        DB::table('our_projects')->where('id', $id)->update($data);

        return redirect()
            ->route('our-projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = DB::table('our_projects')->where('id', $id)->first();

        if (!$project) {
            return redirect()->route('our-projects.index')
                ->with('error', 'Project not found.');
        }

        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        DB::table('our_projects')->where('id', $id)->delete();

        return redirect()
            ->route('our-projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
