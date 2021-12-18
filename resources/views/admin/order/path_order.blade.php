@extends('layouts.backend')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
@endsection
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
            <h4>Path Order</h4>
            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link" id="new-order-tab" href="{{ url('admin/order')}}" aria-controls="new-order" aria-selected="true">New Order</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " id="confirm-order-tab" href="{{url('admin/confirm-order')}}" aria-controls="confirm-order" aria-selected="false">Confirm Order</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-below-messages-tab" href="{{url('admin/path')}}" aria-controls="custom-content-below-messages" aria-selected="false">Path</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="tab-pane fade show active" id="confirm-order" role="tabpanel" aria-labelledby="confirm-order-tab">
                 <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>S.No</th>
                              <th>Ref./Part No</th>
                              <th>Products</th>
                              <th>Total(Tax Inc)</th>
                              <th>Dimension</th>
                              <th>Delivery Status</th>
                              <th>Invoice</th>
                              <th>Manifest</th>
                              <th>Shipment Label</th>
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
                                  @foreach($ref_nos as $key=>$val)
                                  {{ $val }} 
                                  <br>
                                  @endforeach
                              </td>
                              <td>
                                  @foreach($pr_names as $key=>$pname)
                                  {{ $pname }} - ( {{ $pr_quantities[$key] }} ) 
                                  - ( ₹{{ $pr_prices[$key] }} ) 
                                  -({{$attr[$key]}})
                                  <br>
                                  @endforeach
                              </td>
                              <td>₹ {{ $order->total_amount }}</td>
                              <td><p>
                                  <strong>Height : </strong> {{$order->height}} <br>
                                  <strong>Length : </strong> {{$order->length}} <br>
                                  <strong>Width : </strong> {{$order->width}} <br>
                                  <strong>Weight : </strong> {{$order->weight}}
                                  </p>
                              </td>
                              <td>
                                <select name="orderStatus" class="deliveryStatus">
                                  <option @if(empty($order->delivery_status)) selected="true" @endif value="{{$order->id}}">Pending</option>
                                  <option @if(!empty($order->delivery_status == 'Dispatched')) selected="true" @endif value="{{$order->id}}">Dispatched</option>
                                </select>
                              </td>
                              <td> <a href="{{url('admin/download-invoice/'.$order->id)}}">Download</a>
                                </td>
                              <td><a href="{{url('admin/download-shipment-level/'.$order->id)}}">Download</a></td>
                              <td><a href="{{url('admin/download-pdf/'.$order->id)}}">Download</a></td>
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
            <div class="card-body">
            
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div id="res_model"></div>
    </section>
@endsection

@section('custom_script')
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
     $("table tbody").on('change','.deliveryStatus',function() { 
       id = this.value;
       name = $(this).find(":selected").text();
       $.ajax({
            type: "POST",
            url: "delivery-status",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id, name:name
            },
            success: function (res) {
              setTimeout(function(){
                  window.location.reload(true);
              }, 100);
            }
        });
    });
  });
</script>
@endsection