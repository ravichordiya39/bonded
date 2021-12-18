@extends($layout)
@section('content')
<section class="site-content">
    <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
        <div class="container">
            <div class="page-banner-wrap">
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                <ul class="breadcrumb-items">
                    <li class="breadcrumb-item trail-begin"><a href="{{url('/')}}" rel="home"><span itemprop="name">Home</span></a></li>
                    <li class="breadcrumb-item trail-end"><span itemprop="name">Cart</span></li>
                </ul>
            </div>      
        </div>
        </div>
        </div>
    </div>
    <!-- page-banner-section -->
    <div class="content-wrapper">
        <div class="container">
	        <div class="page-header text-center">
	            <h1 class="page-title">Cart</h1>
	        </div>
        	<div class="row">
            	<div class="content-area col-12">
                	<div class="content-section">
                		<div class="row">
                    		<div class="col-lg-8 col-md-8 col-12">
                        		<div class="cart-form-wrapper">
                            		<form class="cart-form" action="cart" method="post">
                              		<div class="cart-items">  
                                        @php
                                        $price=0;
                                        $total=0;
                                        $shipping=0;
                                        $tax=0
                                        @endphp
                              			@if(isset($cart) && $cart && count($cart))
                            			@foreach($cart as $pd) 
                                            @php
                                            $pdetail=$pd['pdetail'];
                                            $maxp=$sellp=$gst=0;
                                            if(isset($pdetail->inr_sell_price) && $pdetail->inr_sell_price){
                                                $maxp=$pdetail->inr_price??0;
                                                $sellp=$pdetail->inr_sell_price??0;
                                            }else{
                                                $sellp=$pdetail->inr_price??0;
                                            }
                                            $sells =  $sellp*$pd['qty'];
                                            $gst=$pd['detail']->gst??0;
                                            $price+=$sells;
                                            $tax=$tax+(($sells*$gst)/100);
                                            if($price<999){
                                                $shipping=150;
                                            }
                                        @endphp
                                  		<div class="cart-item">
                                    		<div class="cart-image">
                                      		<a href="{{$pd['detail']->url??'javascript:;'}}"><img src="{{$pd['detail']->thumbnail_url??''}}"></a>
                                    		</div>
                                    		<div class="cart-desc">
                                      		<p class="cart-title"><a href="{{$pd['detail']->url??'javascript:;'}}">{{$pd['detail']->name??''}} Bedding Set Product</a></p>
                                      		<p class="cart-meta"><span>Size : {{$pdetail->sizeDetail->name??''}}</span></p>
                                      		<p class="cart-price">
                                        		<span class="price">
                                                @if($maxp)   
                                          		<del><span class="Price-amount amount"><span class="Price-currencySymbol">₹</span> {{$maxp}}</span></del>
                                          		<span class="Price-amount amount"><span class="Price-currencySymbol">₹</span> {{$sellp}}</span>
                                                @else
                                                <span class="Price-amount amount"><span class="Price-currencySymbol">₹</span> {{$sellp}}</span>
                                                @endif
                                        		</span>
                                      		</p>
                                      		<div class="cart-quantity">
                                                <div class="quantity-group">
                                                    <p class="cart-meta"> <span>Quantity : {{$pd['qty']}}</span></p>
                                                </div>
	                                        	<!-- <div class="quantity-group">
	                                          		<a href="javascript:void(0)" class="dec qty-btn"></a>
	                                          		<input type="text" id="quantity" class="input-text qty" name="quantity" value="1" maxlength="50">
	                                          		<a href="javascript:void(0)" class="inc qty-btn"></a>
	                                        	</div> -->
                                        		<p class="cart-subtotal"><span class="price"><span class="Price-currencySymbol">₹</span> {{$sellp*$pd['qty']}}</span></p>
                                      		</div>                                     
                                    		</div>
		                                    <div class="cart-action">
		                                      <div class="cart-action-button">
		                                        <a href="javascript:;" data-id="{{$pd['detail']->id}}" class="@if($pd['detail']->isWished()) remove_to_wishlist @else add_to_wishlist @endif add-to-wishlist"  tabindex="-1"><i class="far fa-heart"></i></a> 

		                                        <a href="javascript:;" data-id="{{$pd['detail']->id}}" class="remove-to-cart remove-item" title="Remove this item" data-product_id="86" data-product_sku=""><i class="fa fa-times"></i></a>
		                                      </div>
		                                    </div>
                                  		</div>
                                  <!--cart-item-->
                                  @endforeach
                                  @else
                                  <div> <h4>Cart Empty</h4></div>
                                  @endif
                                </div>
                                <!-- <div class="cart-update">       
                                <button type="submit" name="update_cart_action" data-cart-item-update="" value="update_qty" title="Update Shopping Cart" class="btn btn-primary action update">
                                  Update Shopping Cart
                              </button>
                            </div> -->
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-12">
                       <div class="cart-collaterals">
                            {{-- <div class="coupon">
                              <label for="coupon_code">Apply Coupon Code</label> 
                              <div class="coupon-group">
                                <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code">
                                <button type="submit" id="apply_coupon" class="button" name="apply_coupon" value="Apply coupon">Apply</button>
                              </div>
                            </div> --}}
                            <div class="cart-totals">
                            <h2>Cart totals</h2>
                            <div class="cart-totals-table">
                            <table class="shop-table" cellspacing="0">
                                <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Subtotal</th>
                                        <td data-title="Subtotal"> <span class="price"><span class="Price-amount amount"><span class="Price-currencySymbol">₹</span>{{$price}}</span></span></td>
                                    </tr>
                                    <tr class="shipping-totals shipping">
                                        <th>Shipping</th>
                                        @if($price<999)
                                        <td data-title="Shipping">{{$shipping}}</td>
                                        @else
                                        <td data-title="Shipping">Free</td>
                                        @endif
                                    </tr>
                                    <tr class="shipping-totals shipping">
                                        <th>Tax</th>
                                        <td data-title="Tax">{{$tax}}</td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td data-title="Total"><strong><span class="price"><span class="Price-amount amount"><span class="Price-currencySymbol">₹</span> {{$price+$shipping+$tax}}</span></span></strong> </td>
                                    </tr>
                                </tbody>
                            </table>
                          </div>
                            <div class="proceed-to-checkout">
                            	@if(Auth::check() && Auth::user()->user_type=='user')
                                <a href="{{url('checkout')}}" class="checkout-button button"> Proceed to checkout</a>
                                @else
                                <a href="javascript:;" class="checkout-button button loginregister"> Proceed to checkout</a>
                                @endif
                            </div>
                        </div>
                    </div>
                  </div>
                </div>    
              
                
                </div>
            </div>
            <!--content-area-->
        </div>
        <!--row-->
        </div>
        <!--content-wrapper -->
    </div>
    <!--container-->
</section>
@endsection
@section('js-script')

@endsection