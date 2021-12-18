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
                  <li class="breadcrumb-item trail-end"><span itemprop="name">Edit Profile</span></li>
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
            <h1 class="page-title">Edit Profile</h1>
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
                      <form action="{{route('edit-profile')}}" enctype="multipart/form-data" method="post" role="form">    
                      <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                          <div class="myaccount-profileimg">
                            <img src="{{$user->image_url}}" alt="{{$user->name??''}}">
                            <div class="myaccount-profileimg-edit">
                              <label for="profileimg-upload" class="profileimg-upload"><i class="fas fa-pencil-alt"></i></label>
                              <input id="profileimg-upload" name="image" id="image" type="file">
                          </div>
                          </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-12">
                           
                              @csrf  
                              <div class="myaccount-row">
                                  <div class="col-md-4 col-sm-12 col-12">
                                    <h4 class="font-weight-semibold">Personal Information</h4>
                                  </div> 
                                  <div class="col-md-8 col-sm-12 col-12">                                     
                                    <div class="form-group">
                                      <label>Full Name</label><input type="text" name="name" value="{{$user->name??''}}" id="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label>Email</label><input type="email" name="email" value="{{$user->email??''}}" id="email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label>Phone No.</label><input type="tel" name="phone" value="{{$user->phone??''}}" class="form-control">
                                    </div> 
                                  </div>  
                                </div>                              
                                <div class="myaccount-row">
                                  <div class="col-md-4 col-sm-12 col-12">
                                    <h4 class="font-weight-semibold">Password</h4>
                                  </div> 
                                  <div class="col-md-8 col-sm-12 col-12">                                     
                                    <div class="form-group">
                                      <label>New Password</label><input type="password" name="password" id="password" value="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                      <label>Confirm New Password</label><input type="password" name="password_confirmation" id="password_confirmation" value="" class="form-control">
                                    </div>                        
                                  </div>  
                                </div>
                                <div class="myaccount-row">
                                  <div class="col-md-4 col-sm-12 col-12">
                                   
                                  </div> 
                                  <div class="col-md-8 col-sm-12 col-12">  
                                    <div class="form-submit">
                                      <input type="submit" value="Submit" class="btn btn-primary">
                                    </div>                        
                                  </div>  
                                </div>
                           
                        </div>
                      </div>
                    </form>                    
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