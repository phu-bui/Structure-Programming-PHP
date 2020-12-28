@extends('layouts.master')
@section('content')

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{route('web.home')}}">Home</a></li>
                    <li class="active">Order cart</li>
                </ol>
            </div>

            <div class="register-req">
                <!--<p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>--->
                <p>Customer information</p>
            </div><!--/register-req-->

            <div class="shopper-informations">
                <div class="row">

                    <div class="col-sm-12 clearfix">
                        <div class="bill-to">
                            <p>Fill in shipping information</p>
                            <div class="form-one">
                                <form  action="{{route('web.save-checkout-customer')}}" method="GET">
                                    {{csrf_field()}}
                                    <input type="text" name="shipping_name" class="shipping_name" placeholder="Your name...">
                                    <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Your phone...">
                                    <input type="text" name="shipping_email" class="shipping_email" placeholder="Your email...">
                                    <input type="text" name="shipping_address" class="shipping_address" placeholder="Your address...">
                                    <textarea name="shipping_notes" class="shipping_notes" placeholder="Notes..." rows="5"></textarea>
                                    <input type="submit" value="Save" name="send_order_place" class="btn btn-primary br-sm">

                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12 clearfix">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif

                    </div>

                </div>
            </div>




        </div>
    </section> <!--/#cart_items-->

@endsection
