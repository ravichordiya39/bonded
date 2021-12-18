@extends($layout)
@section('content')
<section class="site-content">
    <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
        <div class="container">
          <div class="page-banner-wrap">
           <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
               <ul class="breadcrumb-items">
                   <li class="breadcrumb-item trail-begin"><a href="index.html" rel="home"><span itemprop="name">Home</span></a></li>
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
              <!-- <form class="checkout-form" name="contactform" id="contactform" action="{{url('user/payment-process')}}" method="post">
                @csrf-->
               <div class="row flex-row-reverse">
                <div class="col-lg-5 col-md-12 col-12">                         
                  <div class="checkout-order-review">
                    <!--<div class="coupon">-->
                    <!--  <label for="coupon_code">Apply Coupon Code</label> -->
                    <!--  <span id="wrong_coupon" class="d-none">Worng Coupon</span>-->
                    <!--  <div class="coupon-group">-->
                    <!--    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code">-->
                    <!--    <input type="hidden" name="coupon_code_hid" id="coupon_code_hid" value="false">-->
                    <!--    <input type="hidden" name="coupon_code_dis_hid" id="coupon_code_dis_hid" value="0">-->
                    <!--    <input type="hidden" name="coupon_code_dis_type_hid" id="coupon_code_dis_type_hid" value="0">-->
                    <!--    <input type="hidden" name="coupon_code_minimum_purchase" id="coupon_code_minimum_purchase" value="0">-->
                    <!--    <button type="button" class="button" name="apply_coupon" value="Apply coupon" id="apply_coupon">Apply</button>-->
                    <!--  </div>-->
                    <!--</div>-->
                    
                  
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
                                    @foreach ($product as $k=>$item)
                                    <tr class="cart_item">
                                        <input type="hidden" name="product[{{$k}}][id]" id="product{{$k}}" value="{{$item['id']}}">
                                        <td class="product-name">{{$item['name']??'NA'}} &nbsp; <strong class="product-quantity">×&nbsp; {{$item['quantity']??''}}</strong> </td>
                                        <input type="hidden" value="{{$item['quantity']}}" name="product[{{$k}}][quantity]">
                                        <input type="hidden" name="product[{{$k}}][product_detail_id]" value="{{$item['product_detail_id']}}">
                                        <input type="hidden" name="product[{{$k}}][price]" value="{{$item['sell']}}">
                                        <td class="product-total text-right"><span class="Price-amount amount"><span class="Price-currencySymbol">₹</span>{{$item['sell']}}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                  <td>Subtotal</td>
                                        <td class="text-right"><span class="Price-amount amount"><span class="Price-currencySymbol">₹</span> {{$price}}</span></td>
                                        <input type="hidden" name="price" id="price" value="{{$price}}">
                                    </tr>
                                    <tr class="shipping-totals shipping">
                                        <td>Shipping</td>
                                        <td data-title="Shipping" class="text-right">+{{$shipping}}</td>
                                    </tr>
                                    <tr class="shipping-totals shipping">
                                        <td>Tax</td>
                                        <td data-title="Tax" class="text-right">+{{$tax}}</td>
                                    </tr>
                                  <tr class="shipping-totals" id="discount">
                                      <td>Discount</td>
                                      @php
                                      $c =   couponApply();
                                      @endphp
                                      <td data-title="discount" class="text-right" id="discount_val">-{{$c['coupon_discount']}}</td>
                                  </tr>
                                  <!--
                                  <tr class="shipping-totals" id="gift">
                                    <td>Gift Wrap</td>
                                    <td data-title="gift" class="text-right" id=""><span id="gift_wrap">+0.0</span></td>
                                </tr> -->
                                    <tr class="order-total">
                                        <td><strong>Total</strong></td>
                                        <input type="hidden" value="{{$price + $shipping+$tax}}"  id="total_price_99">

                                        <td class="text-right"><strong><span class="Price-amount amount"><span class="Price-currencySymbol">₹</span><span id="total_price"> {{$price + $shipping+$tax}}</span></span></strong> </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!-- .order-table-wrapper -->
                        
                    </div>
                </div>
               </div>
                 <div class="col-lg-7 col-md-12 col-12">
                    <!---start new payment code--->
                          <div class="shipping-section">  
                           <!-- <form action="">-->
                            <div id="payment" class="checkout-payment">
                              <div class="payment-options-list">
                        <ul class="nav payment-options"  role="tablist">  
                          <!--<li>                                     
                              <a class="active" id="payment-wallet-tab" data-toggle="tab" href="#payment-wallet"> <i class="fas fa-wallet"></i> Wallet</a>                                      
                          </li> -->
                          <li>                                     
                            <a id="payment-razorpay-tab" data-toggle="tab" href="#payment-razorpay"><i class="far fa-credit-card"></i>Razorpay </a>                                      
                          </li>
                          <li>                                     
                              <a id="payment-cod-tab" data-toggle="tab" href="#payment-cod" ><i class="fas fa-money-bill"></i>COD </a>                                      
                          </li>
                         <!-- <li>
                              <a id="payment-paypal-tab" data-toggle="tab" href="#payment-paypal"><i class="fab fa-cc-paypal"></i>PayPal </a>                                     
                          </li>-->
                      </ul>
                              </div>                             
                              <div class="payment-methods-option tab-content">  
                                  <!--<div id="payment-wallet" class="payment-method-wallet tab-pane fade show active">                                      
                                      <div class="payment-box payment-box-wallet">
                                          <h4 class="payment-box-title">Pay with your wallet</h4>
                                          <p>Balance : ₹ 1000.00</p>
                                          <button type="submit" class="button btn-block" name="checkout_place_order" id="place_order"  value="Place order" data-value="Place order">Place order</button>  
                                      </div>
                                  </div>--> 
                                  <div id="payment-razorpay" class="payment-method-cod tab-pane fade">                                     
                                    <div class="payment-box payment-box-cod">
                                      <h4 class="payment-box-title"> Pay with Razorpay</h4>
                                        <p>Pay with Razorpay.</p>
                                  <input type="hidden" value="{{$user->name}}" name="u_name" id="u_name">
                                  <input type="hidden" value="{{$user->email}}" name="u_email" id="u_email">
                                  <input type="hidden" value="{{$user->mobile}}" name="u_phone" id="u_phone">
                                  <input type="hidden" value="{{$user->address}}" name="u_address" id="u_address">
                            
                                        <button type="submit" class="button btn-block"  onclick="payment_process()" name="checkout_place_order"   id="makepayment"  value="Place order" data-value="Place order"> Pay ₹  <span id="total_price_2"> {{$total_price}} </span> Online</button>  
                                    </div>
                                </div>
                                  <div id="payment-cod" class="payment-method-cod tab-pane fade show active">                                     
                                      <div class="payment-box payment-box-cod">
                                        <h4 class="payment-box-title">Cash on delivery</h4>
                                          <p>Pay with cash upon delivery.</p>
                                            <form action="{{ url('user/payment-process') }}" method="POST" >
                                              @csrf
                                                @foreach ($product as $k=>$item)
                                                <input type="hidden" name="product[{{$k}}][id]" id="uproduct{{$k}}" value="{{$item['id']}}">
                                                <input type="hidden" value="{{$item['quantity']}}" name="product[{{$k}}][quantity]">
                                                <input type="hidden" name="product[{{$k}}][product_detail_id]]" value="{{$item['product_detail_id']}}">
                                                @endforeach
                                               <input type="hidden" value="{{$price}}" name="price" id="total_price_1">
                                               <input type="hidden" value="{{$total_price}}" name="total_price" id="total_price">
                                               <input type="hidden" value="{{$shipping}}" name="shipping" id="shipping">
                                               <input type="hidden" value="{{$tax}}" name="tax" id="tax">
                                               <input type="hidden" value="{{$shipping_address_id}}" name="shipping_address_id" id="shipping_address_id">
                                               <input type="hidden" value="cod" name="payment_mode" id="payment_mode">
                                              <input type="hidden" name="coupon_code_hid" id="coupon_code_hid" value="{{$coupon_code_hid}}">
                                              <input type="hidden" name="coupon_code_dis_hid" id="coupon_code_dis_hid" value="{{$coupon_code_dis_hid}}">
                                              <input type="hidden" name="coupon_code_dis_type_hid" id="coupon_code_dis_type_hid" value="{{$coupon_code_dis_type_hid}}">
                                              <input type="hidden" name="coupon_code_minimum_purchase" id="coupon_code_minimum_purchase" value="0">
                                              
                                            <input type="hidden" id="payment_id" name="payment_id" value=""/>
                                            <input type="hidden" name="terms-field" value="1">
                                            <input type="hidden" name="gift_hid" id="gift_hid" value="">
                                            <input type="hidden" name="gift_message_hid" id="gift_message_hid" value="">
                                            <input type="hidden" name="gift_to_hid" id="gift_to_hid" value="">
                                            <input type="hidden" name="gift_from_hid" id="gift_from_hid" value="">

                                          <button type="submit" class="button btn-block" name="checkout_place_order" id="place_order"  value="Place order" data-value="Place order">
                                              Pay ₹  <span id="total_price_2"> {{$total_price}} </span>  on Delivery
                                              </button>  
                                      </form>
                                      </div>
                                  </div>
                                  
                                  
                                  
                                  <!--<div id="payment-paypal" class="payment-method-paypal tab-pane fade">                                     
                                      <div class="payment-box payment-box-paypal">
                                        <h4 class="payment-box-title">Pay with PayPal</h4>
                                          <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                          <button type="submit" class="button btn-block" name="checkout_place_order" id="place_order"  value="Place order" data-value="Place order">Place order</button>  
                                      </div>
                                  </div>-->
                              </div>
                              </div>                            
                            <!--</form>-->
                          </div>
                        
                  <!--end new payment code-->
                  <!--start gift--->
                  <!--<div class="checkout-gift-wrapper">
                    <a href="javascript:void(0);" class="gift-wrapper-button" type="button" data-toggle="modal" data-target="#giftwrapper"><i class="fas fa-gift"></i> Gift Wrap</a>

                    <div class="modal fade checkout-gift-wrapper-modal" id="giftwrapper" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title">Gift Wrapper</h3>
                              <button type="button" class="close" id="close_gift" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            
                              <div class="modal-body">
                                {{-- <form method="POST" action=""> --}}
                                  <div class="form-group">
                                    <label>Select Gift Option</label>
                                    <div class="form-group-radio">
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="gift30" name="gift" class="custom-control-input" value="50">
                                        <label class="custom-control-label" for="gift30">Rs. 50</label>
                                      
                                      </div>
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="gift50" name="gift" value="30" class="custom-control-input">
                                        <label class="custom-control-label" for="gift50">Rs. 30</label>
                                      </div>
                                    </div>
                                  </div>  
                                  <p id="gift30_err" class="text-danger"></p>
                                  <div class="form-group">
                                    <label>To</label>
                                    <input type="text" class="form-control" id="gift_to" name="gift_to" placeholder="Enter Recepients Name">                                            
                                    <p id="gift_to_err" class="text-danger"></p>
                                  </div>
                                  <div class="form-group">
                                    <label for="input1">Form</label>
                                    <input type="text" class="form-control"  id="gift_from" name="gift_from" placeholder="Enter Sender's Name" name="gift_from">                                           
                                    <p id="gift_from_err" class="text-danger"></p>
                                  </div>
                                  <div class="form-group"> 
                                    <label for="input1">Message</label> 
                                    <textarea class="form-control"  placeholder="Add your message" id="gift_message" name="gift_message"></textarea>  
                                    <p id="gift_message_err" class="text-danger"></p>
                                  </div>
                                  <div class="form-group">                                           
                                    <input type="button" class="btn btn-primary" onclick="giftadd()" value="SUBMIT">
                                  </div>
                               {{-- </form> --}}
                              </div>
                          </div>
                      </div>
                  </div>




                  </div>-->
                
                <!--end gift-->
                
                <!--gift popup code--->
                <div class="checkout-gift-wrapper">
                    <a href="javascript:void(0);" class="gift-wrapper-button" type="button" data-toggle="modal" data-target="#giftwrapper"><i class="fas fa-gift"></i> Gift Wrap</a>
                      <input type="hidden" name="terms-field" value="1">
                    <input type="hidden" name="gift_hid" id="gift_hid" value="">
                    <input type="hidden" name="gift_message_hid" id="gift_message_hid" value="">
                    <input type="hidden" name="gift_to_hid" id="gift_to_hid" value="">
                    <input type="hidden" name="gift_from_hid" id="gift_from_hid" value="">
                  </div>
                <!--end gift-->                
                 </div>
                </div>
              <!--</form>-->
              </div>
           </div>
          <!--content-area-->
        </div>
        
        
        
        
    <!--start gift popup code --->
     <div class="modal fade checkout-gift-wrapper-modal" id="giftwrapper" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title">Gift Wrapper</h3>
                              <button type="button" class="close" id="close_gift" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            
                              <div class="modal-body">
                               <!-- <form method="POST" action="{{url('user/payment-process')}}">
                                                 @csrf-->
                                  <div class="form-group">
                                    <label>Gift Wrap</label>
                                    <div class="form-group-radio">
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input type="checkbox" id="gift30" name="gift" class="custom-control-input" value="49">
                                        <label class="custom-control-label" for="gift30">Rs. 49</label>
                                      
                                      </div>
                                      <!--<div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="gift50" name="gift" value="30" class="custom-control-input">
                                        <label class="custom-control-label" for="gift50">Rs. 30</label>
                                      </div>-->
                                    </div>
                                  </div> 
                                  
                                  <div class="form-group">
                                    <label>Cotton Shopping Bag</label>
                                    <div class="form-group-radio">
                                      <div class="custom-control custom-radio custom-control-inline">
                                        <input type="checkbox" id="gift50" name="gift50" class="custom-control-input" value="49">
                                        <label class="custom-control-label" for="gift50">Rs. 49</label>
                                      
                                      </div>
                                    </div>
                                  </div> 
                                  
                                  
                                  
                                  <p id="gift30_err" class="text-danger"></p>
                                  <div class="form-group">
                                    <label>To</label>
                                    <input type="text" class="form-control" id="gift_to" name="gift_to" placeholder="Enter Recepients Name">                                            
                                    <p id="gift_to_err" class="text-danger"></p>
                                  </div>
                                  <div class="form-group">
                                    <label for="input1">Form</label>
                                    <input type="text" class="form-control"  id="gift_from" name="gift_from" placeholder="Enter Sender's Name" name="gift_from">                                           
                                    <p id="gift_from_err" class="text-danger"></p>
                                  </div>
                                  <div class="form-group"> 
                                    <label for="input1">Message</label> 
                                    <textarea class="form-control"  placeholder="Add your message" id="gift_message" name="gift_message"></textarea>  
                                    <p id="gift_message_err" class="text-danger"></p>
                                  </div>
                                  <div class="form-group">                                           
                                    <input type="button" class="btn btn-primary" onclick="giftadd()" value="SUBMIT">
                                  </div>
                              <!-- </form>-->
                              </div>
                          </div>
                      </div>
                  </div>
    <!---end gift popup code--->
        
        <!--row-->
      </div>
      <!--content-wrapper -->
    </div>
    <!--container-->
  </section>
@endsection
@section('js-script')
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script>
   
  
function payment_process1(){
 
     var payment_type='paypal';
     if(payment_type=='paypal' && payment_type!==''){
        var s_total=$('#total_price_99').val();
		var amount= s_total;
   
		var amount=parseFloat(100)*parseFloat(amount);
	

          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          var fname= $("#u_name").val();
          var email=$("#u_email").val();
          var mobile=$("#u_phone").val();
          var address1=$("#u_address").val();
          var amount=amount;
          //alert(amount)
          var options = {
              // "key": "rzp_live_oiPhSL1G4oh2eC", // for live
             "key": "rzp_test_NXO9x1hZTHgE2q",
          "amount": amount, // 2000 paise = INR 20*100
          "name": fname,
          "description": "Purchase Description",
          //"image": "/your_logo.png",
          "handler": function (response){
          //alert(response.razorpay_payment_id);
          //alert("Your payment Successfully !");
          
          $('#loader_filter').style.display=""; 
		        autosubmit();
          },
          "prefill": {
          "name": fname,
          "email": email,
          "contact": mobile
          },
          "notes": {
          "address": address1
          },
          "theme": {
          "color": "#F37254"
          },
          "order_id":this.responseText
          };
          var rzp1 = new Razorpay(options);
          rzp1.open();
          }
          };
          var url="{{url('user/payment/razarpayorder')}}?amount="+amount;
          //alert(url);
          xhttp.open("GET", url, true);
          xhttp.send();
          $("#contactform").submit();
     }
  
 //} else
}
function payment_process() {
            // var amount= $("#total_price").value;
          var s_total=$('#total_price_99').val();
			var amount=parseFloat(100)*parseFloat(s_total);
			//alert(amount);

            var name= $("#shipping_first_name").val();
            var email= $("#shipping_email").val();
            var mobile= $("#shipping_phone").val();
            var street_add= $("#street_add").val();

          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
          var fname= $("#shipping_first_name").val();
          var email=$("#shipping_email").val();
          var mobile=$("#shipping_phone").val();
          var address1=$("#street_add").val();
          //alert(amount)
          var options = {
          //"key": "rzp_live_oiPhSL1G4oh2eC", // for live
          "key": "rzp_test_NXO9x1hZTHgE2q",
          "amount": amount, // 2000 paise = INR 20*100
          "name": fname,
          "description": "Purchase Description",
          //"image": "/your_logo.png",
          "handler": function (response){
          //alert(response.razorpay_payment_id);
          //alert("Your payment Successfully !");
          if(response){
            //razorpay
            if(response.razorpay_order_id){
              $("#payment_mode").val('razorpay');
              $("#payment_id").val(response.razorpay_order_id);
              $('#place_order').trigger('click');
            }
            
          }
           
          //$("#chk_loader").style.display="";
          //autosubmit();
          },
          "prefill": {
          "name": fname,
          "email": email,
          "contact": mobile
          },
          "notes": {
          "address": address1
          },
          "theme": {
          "color": "#F37254"
          },
          "order_id":this.responseText
          };
          var rzp1 = new Razorpay(options);
          rzp1.open();

          }
          };
          var url="{{url('user/payment/razarpayorder')}}?amount="+amount;
          //alert(url);

          xhttp.open("GET", url, true);
          xhttp.send();
          
          //alert('wfiw');
          //$("#contactform").submit();
          //autosubmit();
          return false;

  //$("#myForm").submit();
}

function autosubmit()
{
  document.contactform.submit();
}

function giftadd(){
  var status=true;
  /*var gift_first = document.querySelector('input[name="gift"]:checked'); 
  var gift_sec =  document.querySelector('input[name="gift50"]:checked');*/ 
  var gift_first = 0;
  var gift_sec = 0;
  if($('#gift30').checked == true){
    gift_first = $('input[name="gift"]:checked').val(); 
  }
  if($('#gift50').checked == true){
    gift_sec =  $('input[name="gift50"]:checked').val();
  }
  console.log(gift_first)
  console.log(gift_sec)
  var gift=parseInt(gift_first)+parseInt(gift_sec);
  //alert(gift_first+"=="+gift_sec+"++++"+gift);
  var msg=$('#gift_message').val();
  var to=$('#gift_to').val();
  var form=$('#gift_from').val();

  if($('#gift30').checked == true || $('#gift50').checked == true)
  {
    console.log('ture');
    status=true;
    $('#gift30_err').style.display="none";
    // status=false;
    // $('#gift30_err').innerHTML="Select Any option";
  } 
  else{
    console.log('false');
    status=false;
    $('#gift30_err').innerHTML="Select Any option";
    return false;
  // status=true;
  // $('#gift30_err').style.display="none";
  }
  if(msg.trim()==''){
    status=false;
    $('#gift_message_err').innerHTML="Required";
    return false;
  }
  else{
    status=true;
    $('#gift_message_err').style.display="none";
  }
  if(to.trim()==''){
    status=false;
    $('#gift_to_err').innerHTML="Required";
    return false;
  }
  else{
    status=true;
    $('#gift_to_err').style.display="none";
  }
  if(form.trim()==''){
    status=false;
    $('#gift_from_err').innerHTML="Required";
    return false;
  }
  else{
    status=true;
    $('#gift_from_err').style.display="none";
  }
  if(status==false){
    return false;
    return 0;
  }else{ 
  $('#gift_hid').value=gift;
  $('#gift_wrap').innerHTML='+'+gift;
  var s_total=$('#total_price_99').value;
  var total=parseInt(s_total)+parseInt(gift);
 // console.log(total);
  $('#total_price').value=total;
  $('#total_price_99').value=total;

  $('#total_price_1').value=total;
  $('#total_price_2').innerHTML=total;

  $('#total_price').innerHTML=total;
  
  $('#gift_message_hid').value=msg;
  $('#gift_to_hid').value=to;
  $('#gift_from_hid').value=form;//
  
  $('#gift_message').value='';
  $('#gift_to').value='';
  $('#gift_from').value='';
  $('#close_gift').trigger('click');
}
}
  </script>
@endsection
