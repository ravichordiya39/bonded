@extends($layout)
@section('content')
<section class="site-content bg-gray">
  <div class="page-banner-section">
    <div class="page-banner page-banner-bg">
      <div class="container">
        <div class="page-banner-wrap">
          <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
            <ul class="breadcrumb-items">
              <li class="breadcrumb-item trail-begin"><a href="{{url('/')}}" rel="home"><span itemprop="name">Home</span></a></li>
              <li class="breadcrumb-item trail-begin"><a href="{{url('user/order')}}"><span itemprop="name">Orders</span></a></li>
              <li class="breadcrumb-item trail-end"><span itemprop="name">Order Details</span></li>
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
        <h1 class="page-title">Order Details</h1>
      </div>
      <div class="row">
        @include('layouts.common.user-sidebar')
        <!-- sidebar-section -->
        <div class="content-area col-md-9 col-sm-12 col-12">
          <div class="content-section">
            <div class="box-item">
              <div class="box-wrap box-border-bottom box-radius">
                <div class="box-header"><h5 class="box-title">Order Details</h5></div>
                <div class="box-body">
                  <p>
                    Order #<mark class="order-number">1961</mark> was placed on <mark class="order-date">20 Feb 2021 at 11:08 AM</mark> and is currently <mark class="order-status">Processing</mark>.</p>
                  <table class="table table-order-details">
                    <thead>
                        <tr>
                            <th class="product-name">Product</th>
                            <th class="product-total">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="order-item">
                            <td class="product-name">
                                <a href="product-detail.html">Kantha Bed Spreads</a> <strong class="product-quantity">×&nbsp;1</strong>
                            </td>
                            <td class="product-total">
                                <span class="price"><span class="Price-currencySymbol">₹</span> 2,200.00</span>
                            </td>
                        </tr>
                        <tr class="order-item">
                            <td class="product-name">
                                <a href="product-detail.html">Kadamba Printed Bed Sheet</a> <strong class="product-quantity">×&nbsp;1</strong>
                            </td>
                            <td class="product-total">
                                <span class="price"><span class="Price-currencySymbol">₹</span> 2,200.00</span>
                            </td>
                        </tr>
                        <tr class="order-item">
                            <td class="product-name">
                                <a href="product-detail.html">Malti Quilt - Single</a> <strong class="product-quantity">×&nbsp;1</strong>
                            </td>
                            <td class="product-total">
                                <span class="price"><span class="Price-currencySymbol">₹</span> 2,200.00</span>
                            </td>
                        </tr>
                        <tr class="order-item">
                            <td class="product-name">
                                <a href="product-detail.html">Rugs 3x5</a> <strong class="product-quantity">×&nbsp;1</strong>
                            </td>
                            <td class="product-total">
                                <span class="price"><span class="Price-currencySymbol">₹</span> 2,200.00</span>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Subtotal:</th>
                            <td><span class="price"><span class="Price-currencySymbol">₹</span> 2,200.00</span></td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td>Free shipping</td>
                        </tr>
                        <tr>
                            <th>Payment method:</th>
                            <td>PayPal</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td><span class="price"><span class="Price-currencySymbol">₹</span> 2,200.00</span></td>
                        </tr>
                    </tfoot>
                </table>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Payment Address</th>
                      <th>Shipping Address</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Arjun Singh<br>
                        Jaipur<br>
                        jaipur 3201020<br>
                        Rajasthan<br>
                        India</td>
                      <td>Arjun Singh<br>
                        Jaipur<br>
                        jaipur 3201020<br>
                        Rajasthan<br>
                        India</td>
                    </tr>
                  </tbody>
                </table>   
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