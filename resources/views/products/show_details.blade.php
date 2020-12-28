@extends('layouts.master')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <div class="brands_products"><!--brands_products-->
                            <h2>Brands</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($product_details as $key => $brand)
                                        <li><a href="{{route('web.brand_home', array('brand_slug'=>$brand->brand_name))}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->

                        <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range-->

                        <div class="shipping text-center"><!--shipping-->
                            <img src="images/shipping.jpg" alt="" />
                        </div><!--/shipping-->

                    </div>
                </div>
                @foreach($product_details as $key => $product)

                <div class="col-sm-7">
                    <div class="product-information"><!--/products-information-->
                        <td><img width="160" class="" src="{{$product->image}}" alt=""></td>
                        <h2>{{$product->name}}</h2>
                        <p>ID: {{$product->id}}</p>
                            <span>
                                <span>{{number_format($product->price).'VNĐ'}}</span>
                                <label>Count:</label>
                                <input name="qty" type="number" min="1"  value="1" />
                                <input name="productid_hidden" type="hidden"  value="{{$product->id}}" />
                            </span>
                        <p><b>Condition:</b> New 100%</p>
                        <p><b>Brand:</b> {{$product->brand_name}}</p>
                        <a onclick="AddCart({{$product->id}})" href="javascript:" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div><!--/products-information-->
                </div>
            @endforeach

            <!--features_items-->
                <!--/recommended_items-->
            </div>
        </div>
    </section>
    <script>
        function AddCart(id){
            console.log(id);
            $.ajax({
                url: 'addcart/'+id,
                type: 'GET',
            }).done(function(response){
                alertify.success('Add to cart successful!');
            });
        }
    </script>

@endsection
