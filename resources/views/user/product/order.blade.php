@extends($layout)
@section('content')
<section class="site-content bg-gray">
      <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
          <div class="container">
            <div class="page-banner-wrap">
              <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                <ul class="breadcrumb-items">
                  <li class="breadcrumb-item trail-begin"><a href="{{url('')}}" rel="home"><span
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

                      @if($lists)
                      @foreach($lists as $list)
                      @php
                     
                      if($list->order_status == 'pending'){
                          $dClass = 'order-process';
                      }
                      elseif($list->order_status == 'placed'){
                        $dClass = 'order-sucess';
                      }
                      elseif ($list->order_status == 'packed') {
                        $dClass = 'order-sucess';
                      }
                      elseif ($list->order_status == 'delivered') {
                        $dClass = 'order-sucess';
                      }
                      elseif ($list->order_status == 'canceled') {
                        $dClass = 'order-cancel';
                      }
                      else{
                        $dClass = 'order-process';
                      }
                          $product = $list->product;
                      @endphp
                        <div class="order-table">
                          <div class="tabel-row">
                            <div class="table-cell">Order No.-{{$list->order_id}}</div>
                            <div class="table-cell text-right">@php echo date('d F, Y g:i A', strtotime($list->created_at)); @endphp</div>
                          </div>
                          <div class="tabel-row">
                            <div class="table-cell order-img"><a href="{{$product->url}}"><img src="{{$product->thumbnail_url}}" width="75" height="75"></a></div>
                            <div class="table-cell">
                              <p class="order-title"><a href="{{$product->url}}">{{$product->name}} </a></p>
                              @if($list->orderDetails && count($list->orderDetails) > 0)
                              <p class="order-moreitem"><a href="{{url('user/order/'.$list->order_id)}}">+{{count($list->orderDetails)}} More Item</a></p>
                              @endif
                              <p class="order-status  {{$dClass}}">{{ucfirst($list->order_status)}}!</p>
                            </div>
                            <div class="table-cell text-right order-total">
                              <p class="order-price"><i class="fa fa-rupee"></i> {{$list->total_price}}</p>
                              <p class="order-view"><a href="{{url('user/order/'.$list->order_id)}}">View</a></p>
                            </div>
                          </div>
                        </div>
                      @endforeach
                      @endif


                      
                      
                        
                     
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