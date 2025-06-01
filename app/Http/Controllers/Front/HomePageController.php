<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\HomeBanner;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

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
        // $data['products'] = Product::with(['productAttrs' => function ($query) {
        //     $query->select('product_id', 'price');
        // }])->get()->map(function ($product) {
        //     $product->min_price = $product->productAttrs->min('price');
        //     unset($product->productAttrs);
        //     return $product;
        // });

        $data['products'] = Category::with('products:id,category_id,name,slug,image,item_code')->where('slug', $slug)->get();
        return $this->success($data, 'Category products Fetched Successfully');
    }
}
