<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Session;

class OrderController extends Controller
{
    public function admin_view_order($order_code_detail){
        $order_details = DB::table('order_details')->where('id', $order_code_detail)->get();
        foreach ($order_details as $order_detail) {
            $order_id = $order_detail->order_id;
        }
        foreach ($order_details as $order_detail) {
            $product_id = $order_detail->product_id;
        }
        $orders = DB::table('orders')->where('id', $order_id)->get();
        foreach($orders as $key => $order){
            $customer_id = $order->customer_id;
            $shipping_id = $order->shipping_type_id;
        }
        $user_ordered = DB::table('users')->where('id', $customer_id)->get();
        $shipping_ordered = DB::table('shipping_types')->where('id', $shipping_id)->get();
        $product_ordered = DB::table('products')->where('id', $product_id)->get();
        return view('admin::orders.view_order')->with('product_ordered', $product_ordered)
            ->with('shipping_ordered', $shipping_ordered)
            ->with('user_ordered', $user_ordered);

    }

    public function user_addCart(Request $req,$id){
        $product = DB::table('products')->where('id', $id)->first();
        if($product != null){
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->user_AddCart($product, $id);

            $req->Session()->put('Cart', $newCart);
        }
        return view('web::cart');
    }

    public function user_DeleteItemCart(Request $req,$id){
        if(Session::has("Cart") == null){
            return view('web::cart');
        }
        else {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->user_DeleteItemCart($id);
            if(Count($newCart->products) >0){
                $req->Session()->put('Cart', $newCart);
            }
            else{
                $req->Session()->forget('Cart');
            }
            return view('web::list-cart');
        }
    }

}
