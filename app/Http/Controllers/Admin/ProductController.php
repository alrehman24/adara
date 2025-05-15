<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttr;
use App\Models\ProductAttrImages;
use App\Models\Size;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::get();
        return view('admin.Product.product', get_defined_vars());
    }
    public function view_product($id = 0)
    {
        if ($id == 0) {
            $data=new Product();
            $product_attr=new ProductAttr();
            $product_attr_images=new ProductAttrImages();
            $category=Category::get();
            $color=Color::get();
            $size=Size::get();


        } else {
            $data = Product::find($id);
            $validationRules =Validator::make($data, [
                'id' => 'required|integer|exists:products,id',
                'value' => 'required|string',
            ]);
            if ($validationRules->fails()) {
                return redirect()->back()->withErrors($validationRules)->withInput();
            }else
            {
                $data = Product::find($id);
            }
        }
        return view('admin.Product.manage_product', get_defined_vars());
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validationRules = [
            'text' => 'required|string'
        ];

        if ($request->hasFile('image')) {
            $validationRules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $validation = Validator::make($request->all(), $validationRules);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validation->messages()
            ]);
        }

        $userData = [
            'text' => $request->text
        ];

        if ($request->hasFile('image')) {
            $image_name = $request->text . time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/'), $image_name);
            $userData['image'] = 'images/' . $image_name;
        }

        try {
            Product::updateOrCreate(
                ['id' => $request->id],
                $userData
            );

            return response()->json([
                'status' => 200,
                'message' => 'Brand updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error updating brand: ' . $e->getMessage()
            ]);
        }
    }
}
