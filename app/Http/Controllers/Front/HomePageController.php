<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\HomeBanner;
use App\Models\Product;
use App\Models\ProductAttr;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Models\Color;
use App\Models\Size;
use App\Models\TempUser;

class HomePageController extends Controller
{
    use ApiResponse;
    public function getHomeData()
    {
        $data['banners'] = HomeBanner::get();
        $data['categories'] = Category::with('products:id,category_id,name,slug,image,item_code')->get();
        $data['brands'] = Brand::get();
        $data['products'] = Product::with(['productAttrs' => function ($query) {
            $query->select('product_id', 'price');
        }])->get()->map(function ($product) {
            $product->min_price = $product->productAttrs->min('price');
            unset($product->productAttrs);
            return $product;
        });
        return $this->success($data, 'Profile Updated Successfully');
    }
    public function getCategoriesData()
    {
        $data['categories'] = Category::with('subcategories')->where('parent_id', Null)->get();
        return $this->success($data, 'Categories Fetched Successfully');
    }
    public function getCategoryData($slug)
    {

        $data['category'] = Category::where('slug', $slug)->get();
        $data['categoryProducts'] = Product::with(['productAttrs' => function ($query) {
            $query->select('product_id', 'price');
        }])->where('category_id', $data['category'][0]->id)->get()->map(function ($product) {
            $product->min_price = $product->productAttrs->min('price');
            unset($product->productAttrs);
            return $product;
        });

        if ($data['category'][0]->parent_id == null || $data['category'][0]->parent_id == 0) {
            $data['subcategories'] = Category::where('parent_id', $data['category'][0]->id)->withCount('products')->get();
        } else {
            $data['subcategories'] = Category::where('parent_id', $data['category'][0]->parent_id)->withCount('products')->get();
        }

        $data['brands'] = Brand::whereHas('products', function ($query) use ($data) {
            $query->where('category_id', $data['category'][0]->id);
        })->get();

        $colorIds = ProductAttr::whereHas('product', function ($query) use ($data) {
            $query->where('category_id', $data['category'][0]->id);
        })->distinct()->pluck('color_id');
        $data['colors'] = Color::whereIn('id', $colorIds)->get();

        $sizeIds = ProductAttr::whereHas('product', function ($query) use ($data) {
            $query->where('category_id', $data['category'][0]->id);
        })->distinct('size')->pluck('size_id');
        $data['sizes'] = Size::whereIn('id', $sizeIds)->get();

        $data['minPrice'] = ProductAttr::whereHas('product', function ($query) use ($data) {
            $query->where('category_id', $data['category'][0]->id);
        })->min('price');

        $data['maxPrice'] = ProductAttr::whereHas('product', function ($query) use ($data) {
            $query->where('category_id', $data['category'][0]->id);
        })->max('price');

        return $this->success($data, 'Category page data Fetched Successfully');
    }
    public function getUserData(Request $request)
    {

        /// return $request->all();
        $token = $request->token;
        $checkUser = TempUser::where('token', $token)->first();
        if ($checkUser) {
            $data['user_type'] = $checkUser->user_type;
            $data['token'] = $checkUser->token;
            if (checkTokenExpiry($checkUser->updated_at, 60)) {
                $token = generateToken();
                $checkUser->token = $token;
                $checkUser->updated_at = date('Y-m-d H:i:s');
                $checkUser->save();
                $data['token'] = $token;
            }
        } else {
            $user_id = rand(11111,99999);
            $token = generateToken();
            TempUser::create([
                'user_id' => $user_id,
                'token' => $token,
                'user_type' => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            $data['user_type'] = '2';
            $data['token'] = $token;
        }
        return $this->success($data, ' data fatched Successfully');

    }
}
