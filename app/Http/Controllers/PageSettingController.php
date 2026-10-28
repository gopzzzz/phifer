<?php
namespace App\Http\Controllers;


use App\Models\PageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSettingController extends Controller
{
    // Display the form with existing data or an empty form
    public function edit()
    {
        $page = PageSetting::first() ?? new PageSetting();

       return view('edit-page', compact('page'));
    }

    // Save new data or update existing data
    public function save(Request $request)
    {
        $validated = $request->validate([
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'about_us'     => 'nullable|string',
            'mission'      => 'nullable|string',
            'vision'       => 'nullable|string',
            'phone'        => 'nullable|string|max:30',
            'email'        => 'nullable|email|max:255',
            'address'      => 'nullable|string',
            'facebook'     => 'nullable|url|max:255',
            'instagram'    => 'nullable|url|max:255',
            'youtube'      => 'nullable|url|max:255',
        ]);

        // Use the existing record or create a new one
        $page = PageSetting::first() ?? new PageSetting();

        // Upload a new banner only if one is selected
        if ($request->hasFile('banner_image')) {
            if ($page->banner_image) {
                Storage::disk('public')->delete($page->banner_image);
            }

            $validated['banner_image'] = $request
                ->file('banner_image')
                ->store('page-settings', 'public');
        } else {
            // Preserve the existing image
            unset($validated['banner_image']);
        }

        $page->fill($validated);
        $page->save();

        return redirect()
            ->route('admin.edit-page')
            ->with('success', 'Page details saved successfully.');
    }
}