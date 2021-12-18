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
              <li class="breadcrumb-item trail-end"><span itemprop="name">My Account</span></li>
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
        <h1 class="page-title">My Account</h1>
      </div>
      <div class="row">
        @include('layouts.common.user-sidebar')
        <!-- sidebar-section -->
        <div class="content-area col-md-9 col-sm-12 col-12">
          <div class="content-section">
            <div class="box-item">
              <div class="box-wrap box-border-bottom box-radius">
                <div class="box-header"><h5 class="box-title">Profile Information</h5></div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-4 col-sm-12 col-12">
                      <div class="myaccount-profileimg">
                        <img src="{{$user->image_url}}" alt="{{$user->name??''}}">                            
                      </div>
                    </div>
                    <div class="col-md-8 col-sm-12 col-12">
                      <div class="myccount-content">                        
                          <p>{{$user->name??''}}!</p>
                          <!-- <p><strong>User Name : </strong>arjun</p> -->
                          <p><strong>Your Name : </strong>{{$user->name??''}}</p>
                          <p><strong>Email : </strong>{{$user->email??''}}</p>
                          <p><strong>Phone : </strong>+91{{$user->phone??''}}</p>                                                    
                      </div>
                    </div>
                  </div>
                  <hr>    
                  <div class="text-right">           
                    <a class="btn btn-primary" href="edit-profile.html">Edit Profile</a>
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