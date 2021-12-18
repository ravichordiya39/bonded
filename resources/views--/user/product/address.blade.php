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
              <li class="breadcrumb-item trail-end"><span itemprop="name">My Address</span></li>
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
        <h1 class="page-title">My Address</h1>
      </div>
      <div class="row">
        @include('layouts.common.user-sidebar')
        <!-- sidebar-section -->
        <div class="content-area col-md-9 col-sm-12 col-12">
          <div class="content-section">
            <div class="box-item">
              <div class="box-wrap box-border-bottom box-radius">
                <div class="box-header"><h5 class="box-title">Addresses</h5></div>
                <div class="box-body">
                  <div class="address-section">
                    <div class="address-header"> 
                  <h5 class="address-title">
                      Home Address
                      <div class="enable-disable-value"> <a class="enable-value" href="javascript:;">Edit</a> <a class="disable-value d-none" href="javascript:;">Cancel</a> </div>
                      </h5>
                      </div>
                  <div class="address-content"> 
                      <p><strong>Arjun Singh</strong></p>
                      <P>Phone number: 9874563210</P>
                      <p>arjun@gmail.com</p>
                      <p>Sodala, Ajmer Road, Jaipur, Rajasthan-302006</p>               
                  </div>
                  <div class="address-form d-none">
                    <form action="" class="account-form">
                      <div class="row">
                      <div class="form-group col-sm-12 col-12">
                        <button type="submit" class="btn btn-secondary" disabled><i class="fa fa-crosshairs"></i> Use my current location</button>
                      </div>
                        <div class="form-group half-right col-sm-6 col-12">
                          <label>Name</label>
                          <input id="name" class="form-control" name="Name" value="Arjun Singh" placeholder="Name" type="text" disabled>
                        </div>
                        <div class="form-group half-left col-sm-6 col-12">
                          <label>Email</label>
                          <input id="email" class="form-control" name="email" value="arjun@gmail.com" placeholder="Email" type="email" disabled>
                        </div>
                        <div class="form-group half-right col-sm-6 col-12">
                          <label>Phone</label>
                          <input id="phone" class="form-control" name="phone" value="9876543210" placeholder="Phone" type="tel" disabled>
                        </div>
                        <div class="form-group half-left col-sm-6 col-12">
                          <label>Alternate Phone</label>
                          <input id="AlternatePhone" class="form-control" name="AlternatePhone" value="" placeholder="Alternate Phone (Optional)" type="tel" disabled>
                        </div>
                        <div class="form-group col-sm-12 col-12">
                          <label>Address</label>
                          <textarea class="form-control" name="address" placeholder="Address"  disabled>Sodala, Ajmer Road</textarea>
                        </div>
                        <div class="form-group half-right col-sm-6 col-12">
                          <label>Pincode</label>
                          <input id="pincode" class="form-control" name="pincode" value="302019" placeholder="Pincode" type="number" disabled>
                        </div>
                        <div class="form-group half-left col-sm-6 col-12">
                          <label>City</label>
                          <input id="city" class="form-control" name="city" value="Jaipur" placeholder="City" type="text" disabled>
                        </div>
                        <div class="form-group half-right col-sm-6 col-12">
                          <label>State</label>
                          <input id="state" class="form-control" name="state" value="Rajasthan" placeholder="State" type="text" disabled>
                        </div>
                        <div class="form-group half-left col-sm-6 col-12">
                          <label>Landmark</label>
                          <input id="landmark" class="form-control" name="landmark" value="" placeholder="Landmark" type="text" disabled>
                        </div>
                      </div>               
                      <div class="form-group-lg buttons d-none">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="disable-value cancel btn btn-secondary">Cancel</button>
                      </div>
                    </form>
                    </div>
                  </div>

                  <div class="address-section"> 
                    <a class="add-new-address text-uppercase" href="javascript:;" data-toggle="collapse" data-target="#new-address">Add A New Address</a>
                    <div id="new-address" class="collapse mt-3">
                      <form action="">                    
                        <div class="row">
                        <div class="form-group col-sm-12 col-12">
                          <button type="submit" class="btn btn-secondary"><i class="fa fa-crosshairs"></i> Use my current location</button>
                        </div>
                          <div class="form-group half-right col-sm-6 col-12">
                            <label>Name</label>
                            <input id="name" class="form-control" name="Name" value="" placeholder="Name" type="text">
                          </div>
                          <div class="form-group half-left col-sm-6 col-12">
                            <label>Email</label>
                            <input id="email" class="form-control" name="email" value="" placeholder="Email" type="email">
                          </div>
                          <div class="form-group half-right col-sm-6 col-12">
                            <label>Phone</label>
                            <input id="phone" class="form-control" name="phone" value="" placeholder="Phone" type="tel">
                          </div>
                          <div class="form-group half-left col-sm-6 col-12">
                            <label>Alternate Phone</label>
                            <input id="AlternatePhone" class="form-control" name="AlternatePhone" value="" placeholder="Alternate Phone (Optional)" type="tel">
                          </div>
                          <div class="form-group col-sm-12 col-12">
                            <label>Address</label>
                            <textarea class="form-control" name="address" placeholder="Address"></textarea>
                          </div>
                          <div class="form-group half-right col-sm-6 col-12">
                            <label>Pincode</label>
                            <input id="pincode" class="form-control" name="pincode" value="" placeholder="Pincode" type="number">
                          </div>
                          <div class="form-group half-left col-sm-6 col-12">
                            <label>City</label>
                            <input id="city" class="form-control" name="city" value="" placeholder="City" type="text">
                          </div>
                          <div class="form-group half-right col-sm-6 col-12">
                            <label>State</label>
                            <input id="state" class="form-control" name="state" value="" placeholder="State" type="text">
                          </div>
                          <div class="form-group half-left col-sm-6 col-12">
                            <label>Landmark</label>
                            <input id="landmark" class="form-control" name="landmark" value="" placeholder="Landmark" type="text">
                          </div>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Save</button>
                          <button type="button" class="cancel btn btn-secondary">Cancel</button>
                        </div>
                      </form>
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