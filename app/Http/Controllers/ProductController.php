<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return Product::all();
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

    public function store(Request $request)
    {
        $request->validate(['name' => 'required',"description" => "required","price" => "required|numeric"]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return $product;
    }

    public function show($id)
    {
        $product = Product::find($id);

        if($product){
            return $product;
        }else{
            return response()->json(['message' => 'Product not found'],404);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        return $product;
    }

    public function destroy($id)
    {
        return Product::destroy($id);
    }


    //Search
    public function search($search)
    {
        return Product::where('name','LIKE','%'.$search.'%')->get();
    }
}
