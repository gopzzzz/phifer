<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OurProductController extends Controller
{
    // Display all products
    public function index()
    {
        $products = DB::table('our_products')
            ->orderByDesc('id')
            ->get();

        return view('ourproduct', compact('products'));
    }

    // Open create page (form is on index page)
    public function create()
    {
        return redirect()->route('our-products.index');
    }

    // Add product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'product_name' => $validated['product_name'],
            'description' => $validated['description'] ?? null,
            'features' => $validated['features'] ?? null,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('products', 'public');
        }

        DB::table('our_products')->insert(array_merge($data, [
            'created_at' => now(),
            'updated_at' => now(),
        ]));

        return redirect()
            ->route('our-products.index')
            ->with('success', 'Product added successfully.');
    }

    // Edit product
    public function edit($id)
    {
        $product = DB::table('our_products')
            ->where('id', $id)
            ->first();

        if (!$product) {
            return redirect()->route('our-products.index')
                ->with('error', 'Product not found.');
        }

        $products = DB::table('our_products')
            ->orderByDesc('id')
            ->get();

        return view('ourproduct', [
            'products' => $products,
            'editProduct' => $product,
        ]);
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = DB::table('our_products')
            ->where('id', $id)
            ->first();

        if (!$product) {
            return redirect()->route('our-products.index')
                ->with('error', 'Product not found.');
        }

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'product_name' => $validated['product_name'],
            'description' => $validated['description'] ?? null,
            'features' => $validated['features'] ?? null,
            'updated_at' => now(),
        ];

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')
                ->store('products', 'public');
        }

        DB::table('our_products')
            ->where('id', $id)
            ->update($data);

        return redirect()
            ->route('our-products.index')
            ->with('success', 'Product updated successfully.');
    }

    // Delete product
    public function destroy($id)
    {
        $product = DB::table('our_products')
            ->where('id', $id)
            ->first();

        if (!$product) {
            return redirect()->route('our-products.index')
                ->with('error', 'Product not found.');
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        DB::table('our_products')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('our-products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
