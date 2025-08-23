<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function show($id, Request $request)
    {
        $category = $request->query('category');
       
// dd($id);

        // Fetch product details from the API
        return view('productDetails', compact('id', 'category'));
    }
}
