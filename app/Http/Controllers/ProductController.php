<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

class ProductController extends Controller
{
    //Api
    public function getAllProducts()
    {
        $products = Product::with('Category')->get();
        return response()->json(['products' => $products], 200);
    }

    public function getAllProductsForCategory()
    {
        $products = Category::with('products')->get();
        $products->each(function ($category) {
            $category->setRelation('products', $category->products->take(5));
        });
        return response()->json(['products' => $products], 200);
    }
    public function productsByCategory(Category $category)
    {
        $category->load('products');
        $products = $category->products;
        return response()->json(['products' => $products], 200);
    }


    public function getAProduct(Product $product)
    {
        return response()->json(['product' => $product], 200);
    }
    public function createProduct(CreateProductRequest $request)
    {
        $product = new Product($request->all());
        $this->uploadImages($request, $product);
        $product->save();
        if ($request -> ajax()) return response()->json(['product' => $product], 200);
        return back()->with('success', 'Producto creado');
    }

    public function editProduct(Product $product, CreateProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $this->uploadImages($request, $product);
        }
        $product->update($request->except('image'));
        if ($request->ajax()) return response()->json(['product' => $product->refresh()], 200);
        return back()->with('success', 'Producto editado');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return response()->json([], 200);
    }
    //upload image
    private function uploadImages($request, &$product)
    {
        if (!isset($request->image)) return;
        $random = Str::random(20);
        $image_name = "{$random}.{$request->image->clientExtension()}";
        $product->image = $image_name;
        $request->image->move(storage_path('app/public/images'), $image_name);
        $request->image = $image_name;
    }

    //web
    public function showProductsAdmin(){
        return view('products.productsAdmin');
    }
    public function showProductsForCategory(Category $category){
        return view('products.productsForCategory',compact('category'));
    }
}
