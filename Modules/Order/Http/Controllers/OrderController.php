<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Session;
use App\Entities\Cart;


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
        return view('admin.orders.view_order')->with('product_ordered', $product_ordered)
            ->with('shipping_ordered', $shipping_ordered)
            ->with('user_ordered', $user_ordered);

    }

    public function cart(Request $req) {
        return view('cart');
    }

    public function user_addCart(Request $req,$id){
        $product = DB::table('products')->where('id', $id)->first();
        if($product != null){
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->AddCart($product, $id);

            $req->Session()->put('Cart', $newCart);
        }
        return view('cart');
    }

    public function user_DeleteItemCart(Request $req,$id){
        if(Session::has("Cart") == null){
            return view('cart');
        }
        else {
            $oldCart = Session('Cart') ? Session('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->DeleteItemCart($id);
            if(Count($newCart->products) >0){
                $req->Session()->put('Cart', $newCart);
            }
            else{
                $req->Session()->forget('Cart');
            }
            return view('list-cart');
        }
    }

    public function checkout(Request $request){
        $meta_desc = "Đăng nhập thanh toán";
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();

        $brand_product = DB::table('brands')->orderby('brand_id', 'desc')->get();

        return view('checkout.show_checkout')
            ->with('brand_product', $brand_product)
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical);
    }

    public function save_checkout_customer(Request $requests){
        $data = array();
        $data['name'] = $requests->shipping_name;
        $data['phone'] = $requests->shipping_phone;
        $data['email'] = $requests->shipping_email;
        $data['address'] = $requests->shipping_address;
        $data['notes'] = $requests->shipping_notes;

        $shipping_id = DB::table('shipping_types')->insertGetId($data);
        Session::put('shipping_id', $shipping_id);
        return redirect()->route('web.payment');

    }

    public function payment(Request $request){
        $meta_desc = "Đăng nhập thanh toán";
        $meta_keywords = "Đăng nhập thanh toán";
        $meta_title = "Đăng nhập thanh toán";
        $url_canonical = $request->url();
        $brand_product = DB::table('brands')->orderby('brand_id', 'desc')->get();

        return view('checkout.payment')->with('brand_product', $brand_product)
            ->with('meta_desc', $meta_desc)
            ->with('meta_keywords', $meta_keywords)
            ->with('meta_title', $meta_title)
            ->with('url_canonical', $url_canonical);
    }

    public function order_place(Request $request){
        //insert payment
        $data = array();
        $data['name'] = $request->payment_option;
        $data['visible'] = 'Thanh cong';
        if($data['name'] == null){
            Session::put('message', 'Sorry, Please choose your form of payment!');
            return view('checkout.payment');
        }
        else {
            $payment_id = DB::table('payment_types')->insertGetId($data);


            //insert order

            if (session()->has('data-signin')) {
                $user = \App\Entities\User::where('email', session('data-signin')['email'])->first();
            }
            $user_id = $user->id;
            $order_data = array();
            $order_data['customer_id'] = $user_id;
            $order_data['payment_type_id'] = $payment_id;
            $order_data['shipping_type_id'] = Session::get('shipping_id');

            //Nếu gỉỏ hàng rỗng
            if (Session::has('Cart') == null) {
                Session::put('message', 'Sorry, The cart is empty! Please order...');
                return view('checkout.payment');
            } //Giỏ hàng đã có sản phẩm được order
            else {
                foreach (Session::get('Cart')->products as $product) {
                    $order_data['total_prices'] = $product['productInfo']->price;
                }
                $order_data['order_status'] = 1;
                $order_data['order_no'] = rand(1, 100000);
                $order_id = DB::table('orders')->insertGetId($order_data);
                //insert order detail
                $order_detail_data = array();

                foreach (Session::get('Cart')->products as $product) {
                    $order_detail_data['order_id'] = $order_id;
                    $order_detail_data['product_id'] = $product['productInfo']->id;
                    $order_detail_data['quantity'] = $product['quanty'];
                    DB::table('order_details')->insert($order_detail_data);

                }
                if ($data['name'] == 'handcash') {
                    $brand_product = DB::table('brands')->orderby('brand_id', 'desc')->get();
                    foreach (Session::get('Cart')->products as $product) {
                        $product_data = DB::table('products')->where('id', $order_detail_data['product_id'])->get();
                        foreach ($product_data as $item) {
                            $product_quantity = $item->quantity;
                        }
                        $quanti = $product_quantity - $order_detail_data['quantity'];
                        if ($quanti >= 0) {
                            DB::table('products')->where('id', $order_detail_data['product_id'])->update(['quantity' => $quanti]);
                            $request->Session()->forget('Cart');
                            Session::put('message', 'Payment success!');
                            $product_ordered = DB::table('products')->join('order_details', 'products.id', '=', 'order_details.product_id')->where('order_details.order_id', $order_id)->get();
                            $ordered_info = DB::table('orders')->join('shipping_types', 'orders.shipping_type_id', '=', 'shipping_types.id')->where('orders.id', $order_id)->get();

                            return view('checkout.handcash')->with('brand_product', $brand_product)
                                ->with('product_ordered', $product_ordered)
                                ->with('ordered_info', $ordered_info);
                        } else {
                            Session::put('message', 'Sorry, Quantity of products is not enough to order!');
                            return view('checkout.payment');
                        }
                    }
                } else {
                    return view('checkout.paypal');
                }
            }
        }
    }

}
