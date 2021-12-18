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
                  <li class="breadcrumb-item trail-end"><span itemprop="name">My Wishlist</span></li>
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
            <h1 class="page-title">My Wishlist</h1>
          </div>
          <div class="row">
            @include('layouts.common.user-sidebar')
            <!-- sidebar-section -->
            <div class="content-area col-md-9 col-sm-12 col-12">
              <div class="content-section">
                <div class="box-item">
                  <div class="box-wrap box-border-bottom box-radius">
                    <div class="box-header"><h5 class="box-title">My Wishlist</h5></div>
                    <div class="box-body">
                      <ul class="products columns-3">
                      	@if($lists->count())
                      	@foreach($lists as $list)
                        <li class="product-item product product-wishlist-item">
                            <div class="product-wrap">
                              <div class="product-wishlist-remove">                               
                                <a href="javascript:;"  data-id="{{$list->product_id}}" class="remove remove_from_wishlist remove_to_wishlist" title="Remove this product">×</a>
                            </div>
                                <div class="product-image">                                    
                                    <a href="{{$list->product->url??'javascript:;'}}">
                                        <img src="{{$list->product->thumbnail_url??'javascript:;'}}" alt="" class="main-image">
                                    </a>
                                </div>
                                <div class="product-content">
                                    <h5 class="product-title">
                                        <a href="{{$list->product->url??'javascript:;'}}">{{$list->product->name??'javascript:;'}} </a>
                                    </h5>
                                    <div class="product-price">
                                        <span class="price"><span class="Price-currencySymbol">₹</span>2,200.00</span>
                                    </div>
                                    <div class="dateadded">Added on :  {{dateFormat($list->created_at)}}</div>
                                </div>
                                <div class="product-wishlist-addcart">
                                  <a href="#" class="add-cart-button">Add to Cart</a>
                              </div>
                            </div>
                        </li>
                        @endforeach
                        @else
                          <li class="product-item product product-wishlist-item">
                          <div class="product-wrap">Not Available</div></li>
                        @endif
                    </ul>
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