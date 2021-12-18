@extends('layouts.admin')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sales List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
              <li class="breadcrumb-item active">Sales List</li>
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
              <!--<h3 class="card-title float-left">Product Ordered &nbsp;</h3>-->
            </div>
            <div class="card-body">
            <h4>SALES REPORT</h4>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="panel panel-default">
                <div class="panel-heading">
                 <div class="row">
                  <div class="col-md-3"> Total Records - <b><span id="total_records"></span></b></div>
                  <div class="col-md-5">
                   <div class="input-group input-daterange">
                       <input type="text" name="from_date" id="from_date" readonly class="form-control" />
                       <div class="input-group-addon">to</div>
                       <input type="text"  name="to_date" id="to_date" readonly class="form-control" />
                   </div>
                  </div>
                  <div class="col-md-2">
                   <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
                   <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
                  </div>
                  <div class="col-md-2">
                   <a class="btn btn-warning" href="{{ url('reports/export-sales-data') }}">Export Sales Data</a>
                  </div>
                 </div>
                </div>
                <br>
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
                          
                          <strong>Order Date. : </strong> {{ date('d-M-Y', strtotime($order->created_at)) }}
                          @if($order->order__canelled_date)
                          <br><strong>Cancelled Date. : </strong> {{ $order->order__canelled_date }}
                          @endif </p>
                        </td>
                        <td>$order->order_status </td>
                        <td>
                          @if($order->order_status != 'pending')
                          <p><strong>Consignment No : </strong> {{$order->consignment_no}} <br>
                          <strong>Consignment Link : </strong> {{$order->consignment_link}} <br>
                          <strong>Expected Delivery Date : </strong> {{$order->expected_date}} </p>
                          @elseif($order->order_status == 'canceled')
                            Canceled
                          @endif
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

    var date = new Date();

 $('.input-daterange').datepicker({
  todayBtn: 'linked',
  format: 'yyyy-mm-dd',
  autoclose: true
 });

 var _token = $('input[name="_token"]').val();

 fetch_data();

 function fetch_data(from_date = '', to_date = '')
 {
  $.ajax({
   url:"reports/fetch-sales-data",
   method:"POST",
   data:{from_date:from_date, to_date:to_date, _token:_token},
   dataType:"json",
   success:function(data)
   {
    var output = '';
    $('#total_records').text(data.length);
    for(var count = 0; count < data.length; count++)
    {
     output += '<tr>';
     output += '<td>' + data[count].id + '</td>';
     output += '<td>' + data[count].shipping + '</td>';
     output += '<td>' + data[count].order_id + '</td>';
     output += '<td>' + data[count].order_status + '</td>';
     output += '<td>' + data[count].deatils + '</td></tr>';
    }
    $('tbody').html(output);
   }
  })
 }

 $('#filter').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
   fetch_data(from_date, to_date);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  fetch_data();
 });


     $("table tbody").on('change','.order_status',function() { 
       id = this.value;
       name = $(this).find(":selected").text();
       $.ajax({
            type: "POST",
            url: "/admin/order-status",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id, name:name
            },
            success: function (msg) {
              window.location.reload(true);
            }
        });
    });

    $("table tbody").on('change','.processed',function() { 
       id = this.value;
       name = $(this).find(":selected").text();
       $.ajax({
            type: "POST",
            url: "/admin/order-processed",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id, name:name
            },
            success: function (msg) {
              window.location.reload(true);
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
              url   :  '/admin/delivery-detail',
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