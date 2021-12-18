@extends('layouts.admin')
@section('content')
<section class="site-content bg-gray">
  
  <!-- page-banner-section -->
  <div class="content-wrapper">
    <div class="container">
      <div class="page-header text-center">
        <h1 class="page-title">Order Details</h1>
      </div>
      <div class="row">
      
        <!-- sidebar-section -->
        <div class="content-area col-md-9 col-sm-12 col-12">
          <div class="content-section">
            <div class="box-item">
              <div class="box-wrap box-border-bottom box-radius">
                <div class="box-header"><h5 class="box-title">Order Details</h5> <a class="btn btn-primary btn-sm btn-dark" href="{{url('admin/all-orders')}}">Go Back</a></div>
                <div class="box-body">
                  <p>
                    Order #<mark class="order-number">{{$single->order_id}}</mark> was placed on <mark class="order-date">@php echo date('d F, Y g:i A', strtotime($single->created_at)); @endphp</mark> and is currently <mark class="order-status">{{ucfirst($single->order_status)}}</mark>. @if($single->order_status=='delivered')<a href="{{route('download',$single->order_id)}}">Download Invoice</a> @endif</p>
                  @if ($single->order_status=='delivered' || $single->order_status=='placed' || $single->order_status=='packed')
                  <p>Want to cancel this order <a href="javascript:void(0);" data-toggle="modal" data-target="#cancel_order">Cancel Order</a> </p>
                  @endif
                  
                  
                    <table class="table table-order-details">
                    <thead>
                        <tr>
                          <th class="product-name">Product Image</th>
                            <th class="product-name">Product</th>
                            <th class="product-total">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                      @if($lists)
                        @foreach ($lists as $list)
                        @php
                             
                             $product = $list->product;
                        @endphp
                        <tr class="order-item">
                          <td class="product-name">
                           <img src="{{$product->thumbnail_url}}" alt=""/>
                        </td>
                          <td class="product-name">
                              <a href="{{$product->url}}">{{$product->name}}</a> <strong class="product-quantity">×&nbsp;{{$list->quantity}}</strong>
                          </td>
                          <td class="product-total">
                              <span class="price"><span class="Price-currencySymbol">₹</span> {{$list->price}}</span>
                          </td>
                      </tr>
                        @endforeach
                      @endif
                        
                        
                        
          


                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Subtotal:</th>
                            <td></td>
                            <td><span class="price"><span class="Price-currencySymbol">₹</span> {{$single->price}}</span></td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td></td>
                            <td colspan="2">{{$single->shipping}}</td>
                        </tr>
                        <tr>
                            <th>Payment method:</th>
                            <td></td>
                            <td>{{ucfirst($single->payment_mode)}}</td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td></td>
                            <td><span class="price"><span class="Price-currencySymbol">₹</span> {{$single->total_price}}</span></td>
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
                      <td>
                      @if ($user->billingAddress)
                        {{$user->billingAddress->name}}<br>
                        {{$user->billingAddress->address1}}<br>
                        {{$user->billingAddress->city}} {{$user->billingAddress->pincode}}<br>
                        {{$user->billingAddress->state}}<br>
                        {{$user->billingAddress->country}}
                      @endif
                    </td>
                      <td>{{$single->shippingAddress->name}}<br>
                        {{$single->shippingAddress->address1}}<br>
                        {{$single->shippingAddress->city}} {{$single->shippingAddress->pincode}}<br>
                        {{$single->shippingAddress->state}}<br>
                        {{$single->shippingAddress->country}}</td>
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


<div class="modal fade loginregister-modal" id="cancel_order" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <div class="modal-body">
              <div class="row">
                  <div class="modal-left-column pr-md-0 col-lg-12 col-md-12 col-sm-12 col-12">
                      <div class="modal-left-wrap">
                          <div class="modal-login">
                              <div class="modal-left-header">
                                 
                                  <p>Cancel Order.</p>
                              </div>
                              <form method="POST" action="{{ url('user/cancel-order') }}">
                                  @csrf
                                  @if ($single->payment_mode =='cod')
                                  <div class="form-group">
                                    <label for="email">You want to ?</label>
                                      <select name="order_status">
                                        <option value="canceled">Cancel</option>
                                        <option value="return">Replace</option>
                                      </select>
                                </div>
                                  @elseif($single->payment_mode =='razorpay')
                                  <div class="form-group">
                                    <label for="email">You want to ?</label>
                                      <select name="order_status">
                                        <option value="canceled">Cancel</option>
                                        <option value="return">Replace</option>
                                        <option value="refund">Refund</option>
                                      </select>
                                  </div>
                                
                                  @endif
                                  
                                  <div class="form-group">
                                      <label for="email">Enter Your Reason</label>
                                      <textarea name="cancellation_reason" id="cancellation_reason"></textarea>
                                  </div>
                                    <input type="hidden" id="cancel_reason_hid" name="cancel_reason_hid" value="{{$single->order_id}}"/>
                                    <input type="hidden" id="cancel_id" name="cancel_id" value="{{$single->id}}"/>
                                 
                                  <div class="form-submit">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                              </form>
                             
                             
                          </div>
                          
                      </div>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>
</div>
@endsection