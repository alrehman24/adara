<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttr;
use App\Models\ProductAttrImages;
use App\Models\Size;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
            $data = new Product();
            $product_attr = new ProductAttr();
            $product_attr_images = new ProductAttrImages();
            $category = Category::get();
            $brand = Brand::get();
            $color = Color::get();
            $size = Size::get();
            $tax = Tax::get();
        } else {
            $data = Product::find($id);
            $validationRules = Validator::make($data, [
                'id' => 'required|integer|exists:products,id',
                'value' => 'required|string',
            ]);
            if ($validationRules->fails()) {
                return redirect()->back()->withErrors($validationRules)->withInput();
            } else {
                $data = Product::find($id);
            }
        }
        return view('admin.Product.manage_product', get_defined_vars());
        prx(get_defined_vars());
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            prx($request->all());
            $validationRules = [
                'name' => 'required|string',
                'slug' => 'required|string',
                'image' => 'mimes:jpeg,png,jpg,gig|max:5120',
                'category' => 'required|exists:categories,id' //,
                // 'category' => 'required|exists:categories,id',
                // 'category' => 'required|exists:categories,id',
                // 'category' => 'required|exists:categories,id',
                // 'text' => 'required|string',
                // 'text' => 'required|string',
                // 'text' => 'required|string',
                // 'text' => 'required|string',

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
            } else {
                if ($request->id > 0) {
                    $image = Product::find($request->id);
                    if ($request->hasFile('image')) {
                        $imageName =  saveImage($request, 'image', 'images/products/');
                    }
                } else {
                    if ($request->hasFile('image')) {

                        $imageName =  saveImage($request, 'image', 'images/products/');
                    }
                }
            }
            exit;
            $userData = [
                'text' => $request->text
            ];

            if ($request->hasFile('image')) {

                $imageName =  saveImage($request, 'image', 'images/products/');
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
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Error updating brand: ' . $e->getMessage()
            ]);
        }
    }

    public function getAttributes($category_id)
    {
        $attributes = CategoryAttribute::where('category_id', $category_id)->with('attribute', 'values')->get();
        // prx($attributes->toArray());
        return response()->json([
            'status' => 200,
            'data' => $attributes,
            'message' => 'attribute data '
        ]);
    }
}
