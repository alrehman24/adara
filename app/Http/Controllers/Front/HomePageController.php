<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\HomeBanner;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class HomePageController extends Controller
{
    use ApiResponse;
    public function getHomeData()
    {
        $data['banner'] =HomeBanner::get();
        $data['categories'] =Category::with('products')->get();
        $data['brands']=Brand::get();
        return $this->success(['data'=>$data],'Profile Updated Successfully');
    }
    public function getCategoriesData()
    {
        $data['categories'] =Category::with('subcategories')->where('parent_id',Null)->get();
        return $this->success($data,'Categories Fetched Successfully');

    }
}
