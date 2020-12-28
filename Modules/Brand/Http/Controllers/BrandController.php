<?php

namespace Modules\Brand\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;

class BrandController extends Controller
{
    public function show_brand_home($brand_slug){
        $brand_product = DB::table('brands')->orderby('brand_id','desc')->get();

        $product_by_brand = DB::table('products')->join('brands','products.brand_id','=','brands.brand_id')->where('brands.brand_slug',$brand_slug)->get();

        $brand_name = DB::table('brands')->where('brands.brand_slug',$brand_slug)->limit(1)->get();

        return view('brands.show_brand')->with('brand_product',$brand_product)->with('product_by_brand',$product_by_brand)->with('brand_name',$brand_name);
    }
}
