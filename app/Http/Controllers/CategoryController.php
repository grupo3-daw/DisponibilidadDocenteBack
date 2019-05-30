<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = Category::all();

        return response()->json([
            'categories' => $categories
        ], 201);
    }

    public function create(Request $request)
    {
        $category = new Category();
        
        $category->name = $request->name;
        $category->hours = $request->hours;

        $category->save();

        return response()->json([
            'message' => 'Successfully created category!'
        ], 201);
    }

    public function update(Request $request, $id)
    {
        //$category = new Category();

        $category = Category::find($id);
        
        $category->name = $request->name;
        $category->hours = $request->hours;

        $category->update();

        return response()->json([
            'message' => 'Successfully updated category!'
        ], 201);
    }

    public function get($id)
    {
        $category = Category::find($id);
        
        return response()->json([
            'category' => $category
        ], 201);
    }
}
