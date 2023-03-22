<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function addCategorey(Request $request)
    {
        //validate
        $data = $request->validate([
            "category_name"=>"required|unique:categories",
        ]);

        //create
        $category = Categories::create([
            'category_name' => $data['category_name'],
        ]);

        return response()->json(
            [
                'status' => 200,
                'message' => 'Category Added Successfully',
                'data' => $category,
            ],
            200
        );
    }

    public function getCategories()
    {
        $data = Categories::all()->toArray();

        return response()->json([
            'status' => 200,
            'message' => 'Categories Get Successfully',
            'data' => $data,
        ]);
    }

    public function deleteCategories(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $data = Categories::find($request['id']);
        $data->delete();
        $list = Categories::all()->toArray();

        return response()->json([
            'status' => 200,
            'message' => 'Category Deleted Successfully',
            'data' => $list,
        ]);
    }
}
