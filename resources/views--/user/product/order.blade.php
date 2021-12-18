@extends($layout)
@section('content')
<section class="site-content bg-gray">
      <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
          <div class="container">
            <div class="page-banner-wrap">
              <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                <ul class="breadcrumb-items">
                  <li class="breadcrumb-item trail-begin"><a href="index.html" rel="home"><span
                        itemprop="name">Home</span></a></li>
                  <li class="breadcrumb-item trail-end"><span itemprop="name">My Orders</span></li>
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
            <h1 class="page-title">My Orders</h1>
          </div>
          <div class="row">
            @include('layouts.common.user-sidebar')
            <!-- sidebar-section -->
            <div class="content-area col-md-9 col-sm-12 col-12">
              <div class="content-section">
                <div class="box-item">
                  <div class="box-wrap box-border-bottom box-radius">
                    <div class="box-header"><h5 class="box-title">Order History</h5></div>
                    <div class="box-body">
                      <div class="order-table">
                        <div class="tabel-row">
                          <div class="table-cell">Order No.-1010103</div>
                          <div class="table-cell text-right">25 Feb 2021 04:08 PM</div>
                        </div>
                        <div class="tabel-row">
                          <div class="table-cell order-img"><a href="{{url('user/order/id')}}"><img src="images/product-1.jpg" width="75" height="75"></a></div>
                          <div class="table-cell">
                            <p class="order-title"><a href="product-detail.html">High Quality Cotton Jacquard Satin Four-Piece Bedding Set Product </a></p>
                            <p class="order-status order-process">Processing!</p>
                          </div>
                          <div class="table-cell text-right order-total">
                            <p class="order-price"><i class="fa fa-rupee"></i> 1500.00</p>
                            <p class="order-view"><a href="my-order-detail.html">View</a></p>
                          </div>
                        </div>
                      </div>
                      <div class="order-table">
                        <div class="tabel-row">
                          <div class="table-cell">Order No.-1010102</div>
                          <div class="table-cell text-right">20 Feb 2021 11:08 AM</div>
                        </div>
                        <div class="tabel-row">
                          <div class="table-cell order-img"><a href="product-detail.html"><img src="images/product-2.jpg" width="75" height="75"></a></div>
                          <div class="table-cell">
                            <p class="order-title"><a href="product-detail.html">High Quality Cotton Jacquard Satin Four-Piece Bedding Set Product </a></p>
                            <p class="order-status order-sucess">Sucessfully!</p>
                          </div>
                          <div class="table-cell text-right order-total">
                            <p class="order-price"><i class="fa fa-rupee"></i> 1600.00</p>
                            <p class="order-view"><a href="my-order-detail.html">View</a></p>
                          </div>
                        </div>
                      </div>
                      <div class="order-table">
                        <div class="tabel-row">
                          <div class="table-cell">Order No.-1010101</div>
                          <div class="table-cell text-right">15 Feb 2021 06:08 PM</div>
                        </div>
                        <div class="tabel-row">
                          <div class="table-cell order-img"><a href="product-detail.html"><img src="images/product-3.jpg" width="75" height="75"></a></div>
                          <div class="table-cell">
                            <p class="order-title"><a href="product-detail.html">High Quality Cotton Jacquard Satin Four-Piece Bedding Set Product </span></a></p>
                            <p class="order-moreitem"><a href="my-order-detail.html">+2 More Item</a></p>
                            <p class="order-status order-cancel">Cancelled!</p>
                          </div>
                          <div class="table-cell text-right order-total">
                            <p class="order-price"><i class="fa fa-rupee"></i> 4940.80</p>
                            <p class="order-view"><a href="my-order-detail.html">View</a></p>
                          </div>
                        </div>
                      </div>
                        
                     
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