@extends('layouts.admin')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Ordered List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
              <li class="breadcrumb-item active">Product Ordered List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title float-left">Product Ordered &nbsp;</h3>
            </div>
            <div class="card-body">
            <h4>{{strtoupper(Request::segment(3))}} ORDER</h4>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="new-order" role="tabpanel" aria-labelledby="new-order-tab">
                 <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Address</th>
                        <th>Product Detail</th>
                        <th>Order Detail</th>
                        <th>Order Status</th>
                        <th>Delivery Detail</th>
                        <th>Action</th>
                      </tr>
                </thead>
                <tbody>
                    @if(count($orders))
                    @foreach($orders as $order)
                    @php
                   
                    $pr_names = explode(';', $order->product_names);
                    $ref_nos = explode(';', $order->ref_no);
                    $pr_ids = explode(';', $order->product_ids);
                    $pr_quantities = explode(';', $order->product_quantities);
                    $pr_prices = explode(';', $order->product_prices);
                    $attr = explode(';', $order->variation_attr);

                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                          {{-- @php $address=_address($order->address_id)@endphp --}}
                          <p>
                            <strong>Name : </strong> {{$order->shippingAddress->name ? $order->shippingAddress->name:''}}<br>
                            {{--<strong>Email : </strong> {{$order->user?$order->user->email:''}}<br> --}}
                            <strong>Mobile : </strong> {{$order->shippingAddress->phone?$order->shippingAddress->phone:''}}<br>
                          </p>
                          {{-- {{$address?$address->baddress:''}}<br>
                          {{$address?$address->bcity:''}}, 
                          {{$address?$address->bstate:''}}, 
                          {{$address?$address->bpincode:''}} --}}
                        </td>
                        <td>
                          @php 
                               $product = $order->product;
                               $productDetails = $product->pDetail
                            @endphp
                            {{-- @foreach($names as $key=>$val) 
                              <a href="{{url('admin/product/'.$ids[$key])}}">{{ $val}} </a><br>
                              ({{ $qty[$key] }})
                              ({{ $colors[$key] }})
                              ({{ $size[$key] }})
                              ({{ $discounts[$key] }}%)<br>
                            @endforeach --}}
                            ({{$product->name}})
                            ({{$productDetails->sizeDetails->size}})
                            ({{$productDetails->colorDetail->name}})
                        <p><strong>Order Id : </strong> {{$order->order_id}} </p>
                        @if($order->discount_name)
                        <p><strong>Code : </strong> {{$order->discount_name}} </p>
                        <p><strong>Coupon Discount : </strong> {{$order->discount}} </p>
                        @endif
                        </td>
                        <td>
                          <p><strong>Total Amt. : </strong> ₹{{$order->total_price+$order->discount}} <br>
                          <strong>Mode : </strong> {{ $order->payment_mode ? $order->payment_mode:'COD'}} <br>
                          <strong>Delivery Charge. : </strong> ₹{{$order->shipping}} <br>
                          <strong>Order Date. : </strong> {{ date('d-M-Y', strtotime($order->created_at)) }}
                          @if($order->order__canelled_date)
                          <br><strong>Cancelled Date. : </strong> {{ $order->order__canelled_date }}
                          @endif </p>
                        </td>
                        <td>
                          {{-- 'pending','placed','packed','shipped','delivered','canceled','return','refund' --}}
                          <select name="order_status" class="form-control11 order_status">
                              <option value="{{$order->id}}">Pendding</option>
                               <option value="{{$order->id}}" @if($order->order_status=='placed'){!! 'selected' !!} @endif>Placed</option>
                               <option value="{{$order->id}}" @if($order->order_status=='packed'){!! 'selected' !!} @endif>Packed</option>
                               <option value="{{$order->id}}" @if($order->order_status=='shipped'){!! 'selected' !!} @endif>Shipped</option>
                               <option value="{{$order->id}}" @if($order->order_status=='delivered'){!! 'selected' !!} @endif>Delivered</option>
                               <option value="{{$order->id}}" @if($order->order_status=='canceled'){!! 'selected' !!} @endif>Cancelled</option>
                               <option value="{{$order->id}}" @if($order->order_status=='return'){!! 'selected' !!} @endif>Returned</option>
                               <option value="{{$order->id}}" @if($order->order_status=='refund'){!! 'selected' !!} @endif>Refund</option>
                           </select>
                        </td>
                        <td>
                          @if($order->order_status != 'pending')
                          <p><strong>Consignment No : </strong> {{$order->consignment_no}} <br>
                          <strong>Consignment Link : </strong> {{$order->consignment_link}} <br>
                          <strong>Expected Delivery Date : </strong> {{$order->expected_date}} </p>
                          @elseif($order->order_status == 'canceled')
                            Canceled
                          @endif
                        </td>
                        <td>
                          @if($order->order_status != 'pending')
                            <a href="" data-toggle="modal" data-target="#deliveryDetail" class="delivery_date" oid="{{$order->id}}">Delivery</a><br><br>
                            @if($order->order_status == 'Returned')
                              <strong class="btn-danger">Retrun Order</strong>
                            @endif
                          @elseif($order->order_status == 'canceled')
                            Canceled
                          @endif
                           <br><br>
                          <a href="{{ route('order/orderdeails',['id'=>$order->order_id])}}" id="getOrderDetails" class="delivery_date" oid="{{$order->id}}">View Details</a>
                        
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="text-center">No Order Found!</td>
                    </tr>
                    @endif
                </tbody>
              </table>
            </div> 
              </div>
            </div>
          </div>
            <!-- /.card-header -->
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
      <div class="modal fade" id="deliveryDetail">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Delivery Detail</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="delivery_detail" action="#" method="post">
              @csrf
              <div class="modal-body">
                <input type="hidden" name="oid" required="true">
                <div class="form-group">
                  <label class="bmd-label-floating" for="Consignment Number">Consignment</label>
                  <input type="text" name="consignment_no" required="required" class="form-control" placeholder="Consignment Number"/>
                </div>
                <div class="form-group">
                  <label class="bmd-label-floating" for="Consignment link">Consignment Link</label>
                  <input type="text" name="consignment_link" required="required" class="form-control" placeholder="Consignment Link"/>
                </div>
                <div class="form-group">
                  <label class="bmd-label-floating" for="Expected Delivery Date">Expected Delivery Date</label>
                  <input type="text" name="expected_delivery_date" required="required" class="form-control" placeholder="Expected Delivery Date"/>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-primary">Add Delivery Detail</button>
                <p id="res_delivery_detail"></p>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@endsection

@section('js-script')
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });

  $(document).ready(function(){
     $("table tbody").on('change','.order_status',function() { 
       id = this.value;
     
       name = $(this).find(":selected").text();
       $.ajax({
            type: "POST",
             url: ADMIN_URL+"/order-status",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id, name:name
            },
            success: function (msg) {
              if(msg.statusCode==200){
                showNotification(msg.message,'success');
              }
              //window.location.reload(true);
            }
        });
    });


    $("table tbody").on('change','.Shipping',function() { 
       id = this.value;
       name = $(this).find(":selected").text();
       $.ajax({
            type: "POST",
            url: "/admin/order-shipping",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id, name:name
            },
            success: function (msg) {
              //window.location.reload(true);
            }
        });
    });

    $('table tbody').on('click','.delivery_date',function(){
      var oid = $(this).attr('oid');
      $("input[name=oid]").val(oid);
    });

    $('#delivery_detail').on('submit',function(e){
          e.preventDefault();
          $.ajax({
              type  : 'post',
              url   : ADMIN_URL+'/delivery-detail',
              headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
              data  :  $('#delivery_detail').serialize(),
              success:function(res){
                  if(res.success){
                      setTimeout(function(){
                             window.location.reload(true);
                      }, 1000);
                      $('#res_delivery_detail').html(res.message);
                      
                  }
              }
          });
      });

  });
</script>
@endsection