<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class OurProductController extends Controller
{
    public function index()
    {
        $products = DB::table('our_products')
            ->orderByDesc('id')
            ->get();

        return view('ourproduct', compact('products'));
    }
}
