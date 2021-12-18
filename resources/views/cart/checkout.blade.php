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
                   <li class="breadcrumb-item trail-begin"><a href="{{url('product/list')}}"><span >Product List</span></a></li>
                   <li class="breadcrumb-item trail-end"><span itemprop="name">Checkout</span></li>
                </ul>
            </div>      
        </div>
        </div>
      </div>
      </div>
  <!-- page-banner-section -->
  <div class="container">
    <div class="content-wrapper">
      <div class="page-header text-center">
          <h1 class="page-title">Checkout</h1>
      </div>
      <div class="row">
        <div class="content-area col-12">
            <div class="content-section">          
             <div class="row">
               <div class="col-lg-7 col-md-12 col-12">
                <!-- <div class="checkout-login">
                  <h5 class="page-section-title">Sign In</h5>
                  <div class="row">
                    <div class="checkout-login-colmun col-lg-6 col-md-6 col-sm-12 col-12">
                      <div class="checkout-login-area">
                      <h4>I have an Account</h4>
                      <form action="">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>                                  
                        <div class="form-submit">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                        <div class="form-group-forgotpass">
                          <a href="forget-password.html" class="forgot-pass">Forgot Password?</a>
                      </div>
                    </form>
                  </div>
                    </div>
                    <div class="checkout-login-colmun col-lg-6 col-md-6 col-sm-12 col-12">
                      <div class="checkout-login-area">
                      <div class="checkout-login-social">
                        <strong>- OR SIGN IN USING -</strong>
                        <div class="social">
                            <ul class="social-icon">
                                <li class="facebook"><a target="_blank" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li class="google"><a target="_blank" href="#"><i class="fab fa-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="checkout-login-now">
                        <h4>New to Abeer?</h4>
                        <a href="signup.html" class="account-link">Sign Up?</a>
                    </div>
                    </div>
                    </div>
                  </div>
                </div> -->
                <!-- checkout-login -->

                <div class="shipping-section">
                  <div class="shipping-address">
                    <h5 class="page-section-title">Shipping Addrress</h5>
                    <div class="shipping-address-items">
                    	@foreach($saddress as $key=>$add)
                      <div class="shipping-address-item @if($key==0) selected-item  @endif" data-id="{{$add->id}}">
                          <p>{{$add->name??''}} <span class="ml-3">{{$add->phone??''}}</span></p>
                          <p>{{$add->address1??''}} {{$add->address2??''}}, {{$add->city??''}}, {{$add->state??''}}, {{$add->country??''}} - <span>{{$add->pincode??''}}</span></p>
                      </div>
                      @endforeach
                    </div>
                    <div class="new-address-popup">
                      <button type="button" class="btn btn-primary action-show-popup" data-toggle="modal" data-target="#newaddress">
                          <span>New Address</span>
                      </button>
                    </div>
                  </div>
                  <!-- shipping-address -->  
                  <div class="checkout-gift-wrapper">
                    <a href="javascript:void(0);" class="gift-wrapper-button" type="button" data-toggle="collapse" data-target="#giftwrapper"><i class="fas fa-gift"></i> Gift Wrap</a>                              
                    <div class="collapse gift-wrapper" id="giftwrapper">
                      <div class="form-group">
                        <label>Select Gift Option</label>
                        <div class="form-group-radio">
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="gift50" name="gift" class="custom-control-input">
                            <label class="custom-control-label" for="gift50">Rs. 50</label>
                          </div>
                          <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="gift30" name="gift" class="custom-control-input">
                            <label class="custom-control-label" for="gift30">Rs. 30</label>
                          </div>
                        </div>
                      </div>  
                      <div class="form-group">
                        <label>To</label>
                        <input type="text" class="form-control" id="gift_to" name="gift_to" placeholder="Enter Recepients Name" required="">                                            
                      </div>
                      <div class="form-group">
                        <label for="input1">Form</label>
                        <input type="text" class="form-control"  id="gift_from" placeholder="Enter Sender's Name" name="gift_from" required="">                                           
                      </div>
                      <div class="form-group"> 
                        <label for="input1">Message</label> 
                        <textarea class="form-control"  placeholder="Add your message" name="gift_message"></textarea>  
                      </div>
                      <div class="form-group">                                           
                        <input type="submit" class="btn btn-primary" value="SUBMIT">
                      </div>
                
                      </div>



                  </div>
                </div>
               
               
               </div>
               <div class="col-lg-5 col-md-12 col-12">  
               <form method="POST" action="{{url('checkout/payment')}}">    @csrf 
               <input type="hidden" name="shipping_address_id" id="shipping_address_id" value="{{$saddress->first()->id??0}}">                  
                <div class="checkout-order-review">
                  <div class="coupon">
                    <label for="coupon_code">Apply Coupon Code</label> 
                   
                    <div class="coupon-group">
                     
                      <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code">
                      <button type="button" class="button" id="apply_coupon" name="apply_coupon" value="Apply coupon">Apply</button>
                     
                    </div>
                    <span id="wrong_coupon" class="d-none">Worng Coupon</span>
                  </div>
                  <h3 id="order_review_heading">Your order</h3>
                  <div id="order_review" class="checkout-review-order">
                      <div class="order-table-wrapper">
                          <table class="shop_table checkout-review-order-table">
                              <thead>
                                  <tr>
                                      <th class="product-name">Product</th>
                                      <th class="product-total text-right">Subtotal</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @php
                                  $price=0;
                                  $total=0;
                                  $shipping=0;
                                  $tax=0
                                @endphp
                                @foreach($pcarts as $k=>$pd)
                                @php
                                  $pdetail=$pd->pDetail;
                                  $maxp=$sellp=$gst=0;
                                  if(isset($pdetail->inr_sell_price) && $pdetail->inr_sell_price){
                                      $maxp=$pdetail->inr_price??0;
                                      $sellp=$pdetail->inr_sell_price??0;
                                  }else{
                                      $sellp=$pdetail->inr_price??0;
                                  }
                                  $sells = $sellp*$pd->quantity;
                                  $gst=$pd->product->gst??0;
                                  $price+=$sells;
                                  $tax=$tax+(($sells*$gst)/100);
                                  if($price<999){
                                      $shipping=150;
                                  }
                                @endphp
                                  <tr class="cart_item">
                                      <td class="product-name">{{$pd->product->name??''}}&nbsp; <strong class="product-quantity">×&nbsp;{{$pd->quantity??0}}</strong> </td>
                                      <td class="product-total text-right"><span class="Price-amount amount"><span class="Price-currencySymbol">₹</span>{{$sellp}}</span></td>
                                  </tr>
                                  <input type="hidden" name="product[{{$k}}][id]" value="{{$pd->product_id}}">
                                  <input type="hidden" name="product[{{$k}}][quantity]" value="{{$pd->quantity}}">
                                  <input type="hidden" name="product[{{$k}}][product_detail_id]" value="{{$pd->product_detail_id}}">
                                  <input type="hidden" name="product[{{$k}}][name]" value="{{$pd->product->name??''}}">
                                  <input type="hidden" name="product[{{$k}}][sell]" value="{{$sellp??''}}">
                                  @endforeach
                              </tbody>
                              <tfoot>
                                  <tr class="cart-subtotal">
                                      <td>Subtotal</td>
                                      <td class="text-right"><span class="Price-amount amount"><span class="Price-currencySymbol">₹</span> {{$price}}</span></td>
                                  </tr>
                                  <tr class="shipping-totals shipping">
                                      <td>Shipping</td>
                                      @if($price<999)
                                      <td data-title="Shipping" class="text-right">{{$shipping}}</td>
                                      @else
                                      <td data-title="Shipping" class="text-right">Free</td>
                                      @endif
                                  </tr>
                                  <tr class="shipping-totals shipping">
                                      <td>Tax</td>
                                      <td data-title="Tax" class="text-right">+{{$tax}}</td>
                                  </tr>
                                  <tr class="shipping-totals" id="discount">
                                    <td>Discount</td>
                                    <td data-title="discount" class="text-right" id="discount_val">-0.0</td>
                                </tr>
                                  <tr class="order-total">
                                      <td><strong>Total</strong></td>
                                      <td class="text-right"><strong><span class="Price-amount amount" id="total_price2"><span class="Price-currencySymbol">₹</span> {{$price+$tax+$shipping}}</span></strong> </td>
                                  </tr>
                              </tfoot>
                          </table>
                      </div><!-- .order-table-wrapper -->
                     <input type="hidden" name="total_price" id="total_price" value="{{$price+$tax+$shipping}}">
                     <input type="hidden" name="price" id="price" value="{{$price}}">
                     <input type="hidden" name="tax" value="{{$tax}}">
                     <input type="hidden" name="shipping" value="{{$shipping}}">

                     <input type="hidden" name="coupon_code_hid" id="coupon" value="false">
                    <input type="hidden" name="coupon_code_dis_hid" id="coupon_discount" value="0">
                    <input type="hidden" name="coupon_code_dis_type_hid" id="coupon_type" value="0">
                  </div>
                  <div class="proceed-to-payment">
                <input type="submit"  class="button btn-block" value="Proceed to pay">
            	</div>
              </div>
              </form>
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
<div class="modal fade checkout-newaddress-modal" id="newaddress" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title"> Shipping Address</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form method="POST" action="{{url('user/shipping-address')}}">
                                  @csrf      
                                   <input type="hidden" name="shipping_id" id="shipping_id" value="">                          
                              <div class="modal-body">
                                    <div class="shipping-fields-wrapper row">
                                      <div class="form-group col-sm-6 col-12" id="shipping_first_name_field">
                                          <label for="shipping_name" class="">Name <abbr class="required" title="required">*</abbr></label>
                                          <input type="text" class="input-text " name="shipping_name" id="shipping_name" placeholder="" value="" required>      
                                      </div>
                                      <div class="form-group col-sm-6 col-12" id="shipping_phone_field">
                                          <label for="shipping_phone" class="">Phone <abbr class="required" title="required">*</abbr></label>
                                          <input type="tel" class="input-text " name="shipping_phone" id="shipping_phone" placeholder="" value="" required>
                                      </div>
                                      <div class="form-group col-sm-6 col-12" id="shipping_address_1_field">
                                          <label for="shipping_address_1" class="">Street address <abbr class="required" title="required">*</abbr></label>
                                          <input type="text" class="input-text " name="shipping_address1" id="shipping_address1" placeholder="House number and street name" value="" required>
                                      </div>
                                      <div class="form-group col-sm-6 col-12" id="shipping_address_2_field">
                                          <label for="shipping_address_2">Apartment, suite, unit, etc. </label>
                                          <input type="text" class="input-text " name="shipping_address2" id="shipping_address2" placeholder="Apartment, suite, unit, etc. (optional)" value="">
                                      </div>
                                      <div class="form-group col-sm-6 col-12" id="shipping_country_field">
                                          <label for="shipping_country" class="">Country / Region <abbr class="required" title="required">*</abbr></label>
                                          <select name="shipping_country" id="shipping_country" class="country_select" required>
                                              <option value="">Select Country</option>
                                              @foreach($countries as $cntry)
                                              <option data-id="{{$cntry->id}}" value="{{$cntry->name}}">{{$cntry->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                      <div class="form-group col-sm-6 col-12" id="shipping_state_field">
                                          <label for="shipping_state" class="">State <abbr class="required" title="required">*</abbr></label>
                                          <select name="shipping_state" id="shipping_state" class="state_select" required>
                                              <option value="">Select State</option>
                                              <option value="AL">Rajasthan</option>                
                                          </select>
                                      </div>
                                      <div class="form-group col-sm-6 col-12" id="shipping_city_field">
                                          <label for="shipping_city" class="">Town / City <abbr class="required" title="required">*</abbr></label>
                                           <select name="shipping_city" id="shipping_city" class="state_select" required>
                                              <option value="">Select City</option>                
                                          </select>
                                      </div>
                                      <div class="form-group col-sm-6 col-12" id="shipping_postcode_field">
                                          <label for="shipping_postcode" class="">ZIP <abbr class="required" title="required">*</abbr></label>
                                          <input type="text" class="input-text " name="shipping_pincode" id="shipping_pincode" placeholder="" value="" required>
                                      </div>
                                  </div>
                                </div>
                                <div>
                                  <button type="submit" class="btn btn-primary"> Save</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
@endsection
@section('js-script')
<script type="text/javascript">
	$(document).ready(function(){
		var token = '{{csrf_token()}}';
    $(document).on('click','.shipping-address-item',function(){
      var id=$(this).data('id');
      $('.shipping-address-item').removeClass('selected-item')
      $(this).addClass('selected-item')
      $('#shipping_address_id').val(id);
    })
		$(document).on('change','#shipping_country',function(){
			var id=$(this).find(':selected').data('id'); 
			$.ajax({
		    	url : "{{url('config/location')}}",
		    	type: "POST",
		    	data : {country_id:id, _token:token,rtype:'state'},
				 success: function (data, status, xhr) {
	                if (data.status == 1) {
	                    $("#shipping_state").html('');
	                    $("#shipping_state").html(data.data);
	                } else {
	                    swal({
					        title: "Warning",
					        text: data.message,
					        type: "warning",
					        timer: 3000,
					        showConfirmButton: false
					    });             
	                }
	            },
	            failure: function (status) {
	                console.log(status);
	            }
			}); 
		});


		$(document).on('change','#shipping_state',function(){
			var id=$(this).find(':selected').data('id');  
			$.ajax({
		    	url : "{{url('config/location')}}",
		    	type: "POST",
		    	data : {state_id:id, _token:token,rtype:'city'},
				 success: function (data, status, xhr) {
	                if (data.status == 1) {
	                    $("#shipping_city").html('');
	                    $("#shipping_city").html(data.data);
	                } else {
	                    swal({
					        title: "Warning",
					        text: data.message,
					        type: "warning",
					        timer: 3000,
					        showConfirmButton: false
					    });             
	                }
	            },
	            failure: function (status) {
	                console.log(status);
	            }
			}); 
		});
	})




  $(document).ready(function() {
		$("body").on("click","#apply_coupon",function(){ 
           var coupon=$('#coupon_code').val();
			$.ajax({
				url:"{{url('coupon-code')}}?coupon="+coupon,
				type: 'get',
				dataType: 'json',
				success: function(response){
          if(response.status==true){ 
            // $('#apply_coupon').style.disabled;
            $('#apply_coupon').prop('disabled', true);
                    if(response.dis.type=='1'){
                      $("#wrong_coupon").removeClass("d-block");
                      $("#wrong_coupon").addClass("d-none");
                      $('#discount_val').html('-'+response.dis.type_val);
                      $('#coupon_code_dis_hid').val(response.dis.type_val);
                      var s_total=$('#total_price').val();
                      var price=$('#price').val();
                      var tax=$('#tax').val();
                      var shipping=$('#shipping').val();
                      $('#total_price').val(s_total-response.dis.type_val);
                      $('#price').val(price-response.dis.type_val);
                      $('#coupon').val(coupon);
                      $('#coupon_type').val(response.dis.type_coupon);
                      $('#coupon_discount').val(response.dis.coupon_discount);
                      $('#total_price_1').val(s_total-response.dis.type_val);
                       $('#total_price2').html(s_total-response.dis.type_val);
                      $('#total_price_99').html(s_total-response.dis.type_val);
                     
                    }
                    else{
                      $("#wrong_coupon").removeClass("d-none");
                      $("#wrong_coupon").addClass("d-block");
                      $('#coupon').val(''); 
                      $('#coupon_type').val();
                      $('#coupon_discount').val('');
                    }
                    // var element = $("#wrong_coupon");
                    // element.classList.add("d-none");
                    // element.classList.remove("d-block");
                    // $('#coupon_code_hid').value=response.status;
                    // $('#coupon_code_dis_type_hid').value=response.dis.type;
                   
                    // $('#coupon_code_minimum_purchase').value=response.dis.minimum_purchase;
                  
                  }
                  else{
                    var element = $("#wrong_coupon");
                    $("#wrong_coupon").removeClass("d-none");
                    $("#wrong_coupon").addClass("d-block");
                    $('#coupon').val(''); 
                    $('#coupon_type').val();
                    $('#coupon_discount').val('');
                    
                  
                  }

			
			}
		});
		});
	});
</script>
@endsection