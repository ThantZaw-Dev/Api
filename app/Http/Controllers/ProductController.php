<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $route = url()->current();
        $uri_parts = explode('/', $route);
        $uri_tail = end($uri_parts);
        $key_bind = explode("=",$uri_tail);
        // return $key_bind;
        $key = end($key_bind);
        if($key == 123){
            return Product::all();
        }else{
            return response(401);
        }
    }
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
   
        $products = Product::create($request->all());

        return response()->json($products,201);
    }
}
