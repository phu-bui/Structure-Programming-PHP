<?php

namespace Modules\Product\Http\Controllers;
use App\Services\ProductService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
session_start();
use DB;
use Modules\User\Http\Controllers\AdminBaseController;
use Session;

class ProductController extends AdminBaseController
{

    protected $productService;

    public function __construct(ProductService $productService) {
        parent::__construct();

        $this->productService = $productService;
    }

    public function index() {
        $products = $this->productService->getListProduct();
        return view('admin.products.index', compact('products'));
    }

    public function add_product(){
        $brand_product = DB::table('brands')->orderby('brand_id', 'desc')->get();

        return view('admin.products.add_product')->with('brand_product', $brand_product);
    }

    public function save_product(Request $request){
        $data = array();
        $data['product_sku'] = $request->product_sku;
        $data['brand_id'] = $request->brand_id;
        $data['slug'] = $request->slug;
        $data['name'] = $request->name;
        $data['image'] = $request->image;
        $data['price'] = $request->price;
        $data['cost_price'] = $request->cost_price;
        $data['short_description'] = $request->short_description;
        $data['long_description'] = $request->long_description;
        $data['quantity'] = $request->vote;
        $data['status'] = $request->status;

        DB::table('products')->insert($data);
        Session::put('message', 'Add product successful!');
        return redirect()->route('admin.add_product');
    }

    public function edit_product($product_id){
        $brand_product = DB::table('brands')->orderby('brand_id', 'desc')->get();
        $edit_product = DB::table('products')->where('id', $product_id)->get();
        return view('admin.products.edit_product')->with('products', $edit_product)->with('brand_product', $brand_product);
    }

    public function update_product(Request $request, $product_id){
        $data = array();
        $data['product_sku'] = $request->product_sku;
        $data['brand_id'] = $request->brand_id;
        $data['slug'] = $request->slug;
        $data['name'] = $request->name;
        $data['image'] = $request->image;
        $data['price'] = $request->price;
        $data['cost_price'] = $request->cost_price;
        $data['short_description'] = $request->short_description;
        $data['long_description'] = $request->long_description;
        $data['quantity'] = $request->vote;
        $data['status'] = $request->status;

        DB::table('products')->where('id', $product_id)->update($data);
        Session::put('message', 'Update product successful!');
        return redirect()->route('admin.edit_product', array('product_id'=>$product_id));
    }
    public function delete_product($product_id){
        DB::table('products')->where('id', $product_id)->delete();
        Session::put('message', 'Delete product successful!');
        return redirect()->route('admin.products.list');
    }

    public function search(Request $req) {
        $brand_product = DB::table('brands')->orderby('brand_id', 'desc')->get();
        $keywords = $req->keywords_submit;
        $search_product = DB::table('products')->where('name', 'like', '%'.$keywords.'%')->get();
        return view('products.search',compact('search_product'))->with('brand_product', $brand_product);
    }

}
