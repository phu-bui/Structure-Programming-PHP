@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="empty-space col-xs-b15 col-sm-b30"></div>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{route('web.home')}}">Home</a></li>
                <li class="active">Payment</li>
            </ol>
        </div>
        <div class="empty-space col-xs-b15 col-sm-b50 col-md-b100"></div>
        <div class="text-center">
            <div class="simple-article size-3 grey uppercase col-xs-b5">Payment</div>
            <div class="h2">Check your info</div>
            <div class="title-underline center"><span></span></div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @if(Session::has("Cart") != null)
                    <?php
                        $total_price =0;
                        ?>
                <h4 class="h4 col-xs-b25">Your order</h4>
                <div class="cart-entry clearfix">
                    <a class="cart-entry-thumbnail" href="#"><img src="img/product-1.png" alt=""></a>
                    <div class="cart-entry-description">
                        @foreach(Session::get('Cart')->products as $product)

                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="h6"><a href="">{{$product['productInfo']->name}}</a></div>
                                    <div class="simple-article size-1">QUANTITY: {{$product['quanty']}}</div>
                                </td>
                                <td>
                                    <div class="simple-article size-3 grey">PRICE: {{number_format($product['productInfo']->price)}} VND</div>
                                    <div class="simple-article size-1">TOTAL: {{$product['productInfo']->price*$product['quanty']}} VND</div>
                                    <?php
                                        $total_price += $product['productInfo']->price*$product['quanty'];
                                        ?>
                                </td>
                                <td>
                                    <div class="cart-color" style="background: #eee;"></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        @endforeach
                    </div>
                    <h4>Total Price: {{$total_price}} VND</h4>
                </div>
                @endif

                <h4 class="h4 col-xs-b25">Payment method</h4>
                <form action="{{route('web.order-place')}}" method="GET">
                    {{csrf_field()}}
                    <br>
                    <div class="payment-options">
                        <span>
                            <label><input name="payment_option" value="paypal" type="checkbox">Paypal</label>
                        </span>
                        <span>
                            <label><input name="payment_option" value="handcash" type="checkbox">Hand Cash</label>
                        </span>
                        <br>
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                        }
                        ?>
                        <br>
                        <input type="submit" value="order" name="send_order_place" class="btn btn-primary br-sm">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>

@endsection
