@extends($layout)
@section('content')
<section class="site-content">
  <div class="page-banner-section">
    <div class="page-banner page-banner-bg">
      <div class="container">
        <div class="page-banner-wrap">
          <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
            <ul class="breadcrumb-items">
              <li class="breadcrumb-item trail-begin"><a href="{{url('/')}}" rel="home"><span
                    itemprop="name">Home</span></a></li>
              <li class="breadcrumb-item trail-end"><span itemprop="name">Order Confirmation</span></li>
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
        <h1 class="page-title">Order Confirmation</h1>
      </div>
      <div class="row">
        
        <div class="content-area col-md-12 col-sm-12 col-12">
          <div class="content-section">               
            <div class="thankyou-order-received">
              <i class="far fa-check-circle success"></i>
              <p>Thank you. Your order has been received.</p>
            </div>    
            <ul class="order-overview thankyou-order-details order_details">
              <li class="order-overview__order order">
                Order number:	<strong>{{$odetail->order_id??''}}</strong>
              </li>          
              <li class="order-overview__date date">
                Date:	<strong>{{dateFormat($odetail->created_at)}}</strong>
              </li>
                <!-- <li class="order-overview__email email">
                  Email:<strong>demo@gmail.com</strong>
                </li>  -->                 
              <li class="order-overview__total total">
                Total:<strong><span class="Price-amount amount"><bdi><span class="Price-currencySymbol">₹</span>{{$odetail->total_price??''}}</bdi></span></strong>
              </li>
                <li class="order-overview__payment-method method">
                  Payment method:<strong>@if($odetail->payment_mode=='cod') Cash on delivery @else Online @endif</strong>
                </li>
            </ul>
            <div class="order-details">
              <h4 class="order-details-title page-section-title">Order details</h4>
              <table class="table table-order-details shop_table order_details">
                  <thead>
                      <tr>
                          <th class="product-name">Product</th>
                          <th class="product-total text-right">Subtotal</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr class="cart_item">

                          <td class="product-name">{{$odetail->product->name??'NA'}}&nbsp; <strong class="product-quantity">×&nbsp;{{$odetail->quantity??1}}</strong> </td>
                          <td class="product-total text-right"><span class="Price-amount amount"><span class="Price-currencySymbol">₹</span> {{$odetail->price}}</span></td>
                      </tr>
                  </tbody>
                  <tfoot>
                      <tr class="cart-subtotal">
                          <td>Subtotal</td>
                          <td class="text-right"><span class="Price-amount amount"><span class="Price-currencySymbol">₹</span> {{$odetail->price}}</span></td>
                      </tr>
                      <tr class="shipping-totals shipping">
                          <td>Shipping</td>
                          <td data-title="Shipping" class="text-right">@if($odetail->shipping) {{$odetail->shipping}} @else Free @endif</td>
                      </tr>
                      <tr class="shipping-totals shipping">
                          <td>Tax</td>
                          <td data-title="Tax" class="text-right">{{$odetail->tax}}</td>
                      </tr>
                      <tr class="order-total">
                          <td><strong>Total</strong></td>
                          <td class="text-right"><strong><span class="Price-amount amount"><span class="Price-currencySymbol">₹</span>{{$odetail->total_price}}</span></strong> </td>
                      </tr>
                  </tfoot>
              </table>
          </div>
          <div class="customer-details">
            <div class="row">
              <div class="col-md-6 col-sm-12 col-12">
                <h4>Billing address</h4>
                <address>
                    {{$baddress->name}}<br>{{$baddress->address1}} {{$baddress->address2}}<br>{{$baddress->city}} {{$baddress->state}} {{$baddress->pincode}}<br>{{$baddress->country}}
                    <p class="customer-details--phone">{{$baddress->phone}}</p>
                    <!-- <p class="customer-details--email">demo@gmail.com</p> -->
                </address>
              </div>
              <div class="col-md-6 col-sm-12 col-12">
                <h4>Shipping address</h4>
                <address>
                    {{$saddress->name}}<br>{{$saddress->address1}} {{$saddress->address2}}<br>{{$saddress->city}} {{$saddress->state}} {{$saddress->pincode}}<br>{{$saddress->country}}
                    <p class="customer-details--phone">{{$saddress->phone}}</p>
                    <!-- <p class="customer-details--email">demo@gmail.com</p> -->
                </address>
              </div>
            </div>  
        </div>
          </div>
        </div>
        <!--content-area-->
      </div>
      <!-- row -->
    </div>
    <!--container-->
  </div>     
  <!--content-wrapper-->
</section>
@endsection