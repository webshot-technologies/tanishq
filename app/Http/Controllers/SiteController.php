<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Http;
use GuzzleHttp\Client;
class SiteController extends Controller
{


    public function productChoose(Request $request){
        // Check which button was clicked
        if ($request->has('recommended_products')) {

            // Redirect to productList page (adjust route name if needed)
            //  return view('productList');
             return redirect()->route('recommended.products');
        } elseif ($request->has('full_catalogue')) {


            // Redirect to categoryList page (adjust route name if needed)
             return redirect()->route('category.list');

        }
        // Default: show the productChoose view
        return view('categoryList');

    }
    public function recommended_products()
    {
        return view('productList');
    }
    public function category_list(){
       return view('categoryList');
    }
    public function full_catalogue(){
           return view('productList');

    }
    public function product_list($slug)
    {

        if ($slug == 'all-products') {

            return view('categoryList');
        } elseif ($slug == 'full-catalogue') {
            // Logic to fetch full catalog products
            return view('categoryList');
        }

        return view('productList', ['slug' => $slug]);
    }
}
