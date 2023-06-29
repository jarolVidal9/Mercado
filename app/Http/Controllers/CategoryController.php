<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories(){
        $categories = Category::get();
        return response()->json(['categories'=>$categories], 200);
    }
    public function getACategory(Category $category){
        return response()->json(['category'=>$category], 200);
    }
    public function createCategory(Request $request){
        $category = new Category($request->all());
        $category->save();
        return response()->json(['category'=>$category], 202);
    }
    public function editCategory(Category $category,Request $request){
        $category->update($request->all());
        return response()->json(['category'=>$category->refresh()], 200);
    }
    public function deleteCategory(Category $category) {
        $category->delete();
        return response()->json([], 200);
    }

    //web
    public function showCategories(){
        return view('categories.categories');
    }
}
