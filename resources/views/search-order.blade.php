@extends('web::layouts.master')
@section('content')
    <div class="container">
        <div class="empty-space col-xs-b15 col-sm-b30"></div>
        <div class="breadcrumbs">
            <a href="#">home</a>
            <a href="#">checkout</a>
        </div>
        <div class="empty-space col-xs-b15 col-sm-b50 col-md-b100"></div>
        <div class="text-center">
            <div class="simple-article size-3 grey uppercase col-xs-b5">your order has been successfully adopted</div>
            <div class="h2">track your order now</div>
            <div class="title-underline center"><span></span></div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="simple-article size-4 grey">Praesent nec finibus massa. Phasellus id auctor lacus, at iaculis lorem. Donec quis arcu elit. In vehicula purus semeu imperdiet odio, eu interdum justo</div>
                    <div class="empty-space col-xs-b20 col-sm-b35 col-md-b70"></div>
                    <div class="row m10">
                        <div class="col-sm-6">
                            <input class="simple-input" type="text" value="" placeholder="Order ID" />
                            <div class="empty-space col-xs-b20"></div>
                        </div>
                        <div class="col-sm-6">
                            <input class="simple-input" type="text" value="" placeholder="Billing email" />
                            <div class="empty-space col-xs-b20"></div>
                        </div>
                    </div>
                    <div class="button size-2 style-3">
                            <span class="button-wrapper">
                                <span class="icon"><img src="img/icon-4.png" alt=""></span>
                                <span class="text">track</span>
                            </span>
                        <input type="submit"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>
    <div class="empty-space col-xs-b35 col-md-b70"></div>
@endsection
