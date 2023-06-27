<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function getAllProducts(){
        $products = Product::get();
        return response()->json(['products'=>$products], 200);
    }

    public function getAllProductsForCategory(){
        $products = Category::with('Category')->get();
        return response()->json(['products'=>$products], 200);
    }
    
    public function getAProduct(Product $product){
        return response()->json(['product'=>$product], 200);
    }
    public function createProduct(CreateProductRequest $request){
        $product = new Product ($request->all());
        $product->save();
        return response()->json(['product'=>$product], 200);
    }

    public function editProduct(Product $product,CreateProductRequest $request){
        $product->update($request->all());
        return response()->json(['product'=>$product->refresh()], 200);
    }

    public function deleteProduct(Product $product){
        $product->delete();
        return response()->json([], 200);
    }
    
}
