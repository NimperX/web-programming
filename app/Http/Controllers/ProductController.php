<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list() {
        $products = Product::all();

        return view('products.list', ['products' => $products]);
    }

    public function create() {
        $tags = Tag::all();

        return view('products.form', [
            'title' => 'Add Product',
            'tags' => $tags
        ]);
    }

    public function store(Request $request) {

        $new_product = new Product;
        $new_product->name = $request->name;
        $new_product->price = $request->price;

        $new_product->save();
        
        $new_product->tags()->attach($request->tags);

        return redirect()->route('products.list');
    } 
}
