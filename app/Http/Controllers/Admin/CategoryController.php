<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use Illuminate\Support\Facades\Validator;
use  App\Models\Category;
use App\Models\CategoryAttribute;

class CategoryController extends Controller
{
    public function index()
    {
        $data=Category::get();

        return view('admin.Category.category',get_defined_vars());
    }
    public function store(Request $request)
    {
        $validationRules = [
            'name' => 'required|string',
            'slug' =>'required|string'//,
            // 'attrubute_id' =>'required|exists:attributes,id,',




        ];

        $validation = Validator::make($request->all(), $validationRules);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validation->messages()
            ]);
        }

        $userData = [
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id


        ];



        try {
            Category::updateOrCreate(
                ['id' => $request->id],
                $userData
            );

            return response()->json([
                'status' => 200,
                'message' => 'Attribute updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error updating attribute: ' . $e->getMessage()
            ]);
        }
    }
    public function index_category_attribute()
    {
        $data=CategoryAttribute::with('category','attribute')->get();
        $category=Category::get();
        $attribute=Attribute::get();

        return view('admin.Category.category_attribute',get_defined_vars());
    }
    public function store_category_attribute(Request $request)
    {
        $validationRules = [
            'category_id' => 'required',
            'attribute_id' =>'required'//,
        ];

        $validation = Validator::make($request->all(), $validationRules);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validation->messages()
            ]);
        }

        $userData = [
            'category_id' => $request->category_id,
            'attribute_id' => $request->attribute_id
        ];



        try {
            CategoryAttribute::updateOrCreate(
                ['id' => $request->id],
                $userData
            );

            return response()->json([
                'status' => 200,
                'message' => 'Attribute updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error updating attribute: ' . $e->getMessage()
            ]);
        }
    }
}
