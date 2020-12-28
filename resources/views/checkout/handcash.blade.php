@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="empty-space col-xs-b15 col-sm-b30"></div>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{route('web.home')}}">Home</a></li>
                <li class="active">Order detail</li>
            </ol>
        </div>
        <div class="empty-space col-xs-b15 col-sm-b50 col-md-b100"></div>
        <div class="text-center">
            <div class="simple-article size-3 grey uppercase col-xs-b5">Order detail</div>
            <div class="h2">Check your info</div>
            <div class="title-underline center"><span></span></div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message', null);
                }
                ?>
                <br>
                <h4 class="h4 col-xs-b25"></h4>
            </div>
        </div>
    </div>
    <div class="bg-gray-200 space-bottom-3">
        <div class="container">
            <div class="py-5 py-lg-7">
                <h6 class="font-weight-medium font-size-7 text-center mt-lg-1"></h6>
            </div>
            <div class="max-width-890 mx-auto">
                <div class="bg-white pt-6 border">
                    <h6 class="font-size-3 font-weight-medium text-center mb-4 pb-xl-1"></h6>
                    <div class="border-bottom mb-5 pb-5 overflow-auto overflow-md-visible">
                        <div class="pl-3">
                            @foreach($ordered_info as $order)
                                <table class="table table-borderless mb-0 ml-1">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="font-size-2 font-weight-normal py-0">Order no: </th>
                                        <th scope="col" class="font-size-2 font-weight-normal py-0">Order date: </th>
                                        <th scope="col" class="font-size-2 font-weight-normal py-0 text-md-center">Total: </th>
                                        <th scope="col" class="font-size-2 font-weight-normal py-0 text-md-right pr-md-9">Payment method: </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row" class="pr-0 py-0 font-weight-medium">{{$order->order_no}}</th>
                                        <td class="pr-0 py-0 font-weight-medium">{{$order->order_date}}</td>
                                        <td class="pr-0 py-0 font-weight-medium text-md-center">{{$order->total_prices}} VND</td>
                                        <td class="pr-md-4 py-0 font-weight-medium text-md-right">handcash</td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endforeach

                        </div>
                    </div>
                    <div class="border-bottom mb-5 pb-6">
                        <div class="px-3 px-md-4">
                            <div class="ml-md-2">
                                <h6 class="font-size-3 on-weight-medium mb-4 pb-1">Chi tiết đơn hàng</h6>
                                <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 57px;">Title</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 62px;">Quantity</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 49px;">Total price</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($product_ordered as $product)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{$product->name}}</td>
                                            <td>{{$product->quantity}}</td>
                                            <td>{{$product->price*$product->quantity}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @foreach($ordered_info as $order)
                        <div class="border-bottom mb-5 pb-4">
                            <div class="px-3 pl-md-5 pr-md-4">
                                <div class="d-flex justify-content-between">
                                    <span class="font-size-2 font-weight-medium">Total</span>
                                    <span class="font-weight-medium fon-size-2">{{$order->total_prices}} VND</span>
                                </div>
                            </div>
                            <br>
                        </div>
                    @endforeach
                    <div class="px-3 pl-md-5 pr-md-4 mb-6 pb-xl-1">
                        <div class="row row-cols-1 row-cols-md-2">
                            <div class="col">
                                <h6 class="font-weight-medium font-size-22 mb-3">Shipping Address
                                </h6>
                                @foreach($ordered_info as $ship)
                                    <address class="d-flex flex-column mb-0">
                                        <span class="text-gray-600 font-size-2">{{$ship->name}}</span><br>
                                        <span class="text-gray-600 font-size-2">{{$ship->address}}</span><br>
                                        <span class="text-gray-600 font-size-2">{{$ship->phone}} </span><br>
                                        <span class="text-gray-600 font-size-2">{{$ship->email}}</span><br>
                                        <span class="text-gray-600 font-size-2">{{$ship->notes}}</span>
                                    </address>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="empty-space col-xs-b35 col-md-b70"></div>
@endsection
