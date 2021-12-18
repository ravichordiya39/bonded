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
                      <h6>You have {{$lists->count()}} coupon(s) to be redeemed.</h6>
                      @if($lists)
                      @foreach ($lists as $list)
                      <div class="coupon-table">
                        <div class="coupon-heading">@php echo date('d F Y', strtotime($list->coupon->start_date)); @endphp </div>
                        <div class="coupon-desc">
                          <div class="coupon-code">
                            <h6>{{$list->coupon_code}}</h6>
                            <p>{{$list->coupon->description}}</p>
                          </div>
                          <div class="coupon-valid">
                            @if($list->coupon->type=='%')
                            <div class="coupon-offer">
                              <label>Offer</label>
                              <p> Flat {{$list->coupon->per_amt}}%</p>
                            </div>
                            @else
                            <div class="coupon-offer">
                              <label>Offer</label>
                              <p> Flat {{$list->coupon->per_amt}}</p>
                            </div>
                            @endif
                            <div class="coupon-expire">
                              <label>Expires on</label>
                              <p> @php echo date('d F, Y', strtotime($list->coupon->end_date)); @endphp </p>
                            </div>
                          </div>
                        </div>
                      </div>
                  
                      @endforeach
                      @endif
                    
                     
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