@extends($layout)
@section('content')
<section class="site-content bg-gray">
      <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
          <div class="container">
            <div class="page-banner-wrap">
              <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                <ul class="breadcrumb-items">
                  <li class="breadcrumb-item trail-begin"><a href="{{url('/')}}" rel="home"><span
                        itemprop="name">Home</span></a></li>
                  <li class="breadcrumb-item trail-end"><span itemprop="name">My Coupones</span></li>
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
            <h1 class="page-title">My Coupones</h1>
          </div>
          <div class="row">
            @include('layouts.common.user-sidebar')
            <!-- sidebar-section -->
            <div class="content-area col-md-9 col-sm-12 col-12">
              <div class="content-section">
                <div class="box-item">
                  <div class="box-wrap box-border-bottom box-radius">
                    <div class="box-header"><h5 class="box-title">Coupnes</h5></div>
                    <div class="box-body">
                      <h6>You have 2 coupon(s) to be redeemed.</h6>
                      <div class="coupon-table">
                        <div class="coupon-heading"> 13 July 2017 </div>
                        <div class="coupon-desc">
                          <div class="coupon-code">
                            <h6>ABEERJAIPUR10</h6>
                            <p>*Promo code is valid only on the minimum cart value of Rs. 200. *Click "Proceed to Checkout", followed by "Review Order" and enter ABEERJAIPUR10 in "Have Coupon Code?" section. *You can avail 10% discount using this coupon code. *You can use this code for as many orders as you wish till 15th Sep 2017.</p>
                          </div>
                          <div class="coupon-valid">
                            <div class="coupon-offer">
                              <label>Offer</label>
                              <p> Flat 10%</p>
                            </div>
                            <div class="coupon-expire">
                              <label>Expires on</label>
                              <p> 15th July, 2021 </p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- coupon-table -->
                      <div class="coupon-table">
                        <div class="coupon-heading"> 10 July 2021 </div>
                        <div class="coupon-desc">
                          <div class="coupon-code">
                            <h6> ABEERJAIPUR5</h6>
                            <p>*Promo code is valid only on the minimum cart value of Rs. 200. *Click "Proceed to Checkout", followed by "Review Order" and enter ABEERJAIPUR5 in "Have Coupon Code?" section. *You can avail 5% discount using this coupon code. *You can use this code for as many orders as you wish till 14th Sep 2017.</p>
                          </div>
                          <div class="coupon-valid">
                            <div class="coupon-offer">
                              <label>Offer</label>
                              <p> Flat 5%</p>
                            </div>
                            <div class="coupon-expire">
                              <label>Expires on</label>
                              <p> 14th July, 2017 </p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- coupon-table -->
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