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
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected const IMAGE_PATH = 'images/products/';
    protected const ATTR_IMAGE_PATH = 'images/products/attr/';

    public function index()
    {
        try {
            $data = Product::with(['category', 'brand', 'tax'])->get();
            // pd($data->toArray());
            return view('admin.Product.product', get_defined_vars());
        } catch (\Exception $e) {
            Log::error('Error fetching products: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to fetch products. Please try again.');
        }
    }
    public function view_product($id = 0)
    {
        // try {
        $data = $id > 0 ? Product::with(['attributes', 'productAttrs'])->findOrFail($id) : new Product();
        // pd($data->toArray());
        // Load related data
        $category = Category::all();
        $brand = Brand::all();
        $color = Color::all();
        $size = Size::all();
        $tax = Tax::all();
        if ($id > 0) {
            $attributes = CategoryAttribute::where('category_id', $data->category_id)
                ->with(['attribute', 'values'])
                ->get();
        }
        //pd($attributes->toArray());
        $product_attr = new ProductAttr();
        $product_attr_images = new ProductAttrImages();

        return view('admin.Product.manage_product', get_defined_vars());
        // } catch (\Exception $e) {
        //     Log::error('Error viewing product: ' . $e->getMessage());
        //     return redirect()->back()->with('error', 'Unable to view product. Please try again.');
        // }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            // Validation rules
            $validationRules = [
                'name' => 'required|string|max:255',
                // 'slug' => 'required|string|max:255|unique:products,slug,' . $request->id,
                'category' => 'required|exists:categories,id',
                'brand' => 'required|exists:brands,id',
                'tax' => 'required|exists:taxes,id',
                // 'item_code' => 'required|string|max:50|unique:products,item_code,' . $request->id,
                'description' => 'nullable|string',
                'keywords' => 'nullable|string',
                'attribute' => 'required|array',
                'attribute.*' => 'exists:attribute_values,id',
                'sku' => 'required|array',
                'sku.*' => 'required|string|distinct',
                'color' => 'required|array',
                'color.*' => 'exists:colors,id',
                'size' => 'required|array',
                'size.*' => 'exists:sizes,id',
                'mrp' => 'required|array',
                'mrp.*' => 'required|numeric|min:0',
                'price' => 'required|array',
                'price.*' => 'required|numeric|min:0',
            ];

            if ($request->hasFile('image')) {
                $validationRules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:5120';
            }

            $validation = Validator::make($request->all(), $validationRules);

            if ($validation->fails()) {
                return response()->json([
                    'status' => 400,
                    'errors' => $validation->messages()
                ]);
            }

            $imageName = null;
            if ($request->hasFile('image')) {
                $imageName = saveImage($request->file('image'), self::IMAGE_PATH);
            }

            // Create or update product
            $product = Product::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'category_id' => $request->category,
                    'brand_id' => $request->brand,
                    'tax_id' => $request->tax,
                    'description' => $request->description,
                    'image' => $imageName ?? ($request->id ? Product::find($request->id)->image : null),
                    'item_code' => $request->item_code,
                    'keywords' => $request->keywords
                ]
            );

            // Update product attributes
            $product->attributes()->delete();
            foreach ($request->attribute as $val) {
                $product->attributes()->create([
                    'category_id' => $request->category,
                    'attribute_value_id' => $val
                ]);
            }

            // Update product variants and their images
            //$product->productAttrs()->delete();
            foreach ($request->sku as $key => $sku) {
                $paData = [
                    'color_id' => $request->color[$key],
                    'size_id' => $request->size[$key],
                    'sku' => $request->sku[$key],
                    'mrp' => $request->mrp[$key],
                    'price' => $request->price[$key],
                    'length' => $request->length[$key] ?? null,
                    'breadth' => $request->breadth[$key] ?? null,
                    'height' => $request->height[$key] ?? null,
                    'weight' => $request->weight[$key] ?? null,
                ];
                // print_r($paData);
                $productAttr = $product->productAttrs()->updateOrCreate(['id' => $request->productAttrs_ids[$key]], $paData);

                // Handle variant images
                if (isset($request->image_values[$key])) {
                    $imageValue = 'attr_image_' . $request->image_values[$key];

                    // Check if the image field exists in the request
                    if ($request->hasFile($imageValue)) {
                        foreach ($request->file($imageValue) as $image) {
                            // Verify it's a valid uploaded file
                            if ($image instanceof \Illuminate\Http\UploadedFile && $image->isValid()) {
                                try {
                                    $attrImageName = saveImage($image, self::ATTR_IMAGE_PATH);
                                    $productAttr->images()->create([
                                        'product_id' => $product->id,
                                        'image' => $attrImageName
                                    ]);
                                } catch (\Exception $e) {
                                    // Log error if image upload fails
                                    Log::error('Failed to upload image: ' . $e->getMessage());
                                }
                            }
                        }
                    }
                }
            }

            DB::commit();
            // pd($request->all());

            return response()->json([
                'status' => 200,
                'message' => 'Product ' . ($request->id ? 'updated' : 'created') . ' successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing product: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Error processing product: ' . $e->getMessage()
            ]);
        }
    }

    public function getAttributes($category_id)
    {
        try {
            $attributes = CategoryAttribute::where('category_id', $category_id)
                ->with(['attribute', 'values'])
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $attributes,
                'message' => 'Attributes retrieved successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching attributes: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'Error fetching attributes'
            ]);
        }
    }
}
