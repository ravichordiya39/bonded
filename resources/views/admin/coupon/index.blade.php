@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Coupon List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
              <li class="breadcrumb-item active">Coupon List</li>
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
              <h3 class="card-title">Coupon &nbsp; <a href="{{ url('/admin/coupon/create') }}" class="btn btn-primary btn-sm btn-dark" title="Add New">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add New Coupon
                </a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Coupon Name</th>
                        <th>Code</th>
                        <th>Amount/Value</th>
                        <th>Label</th>
                        <th>count</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $item)
                        <tr>                           
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{asset('storage/coupon/'.$item->coupon_img.'')}}" alt="{{$item->coupon_img}}" width="120px"></td>
                            <td>{!! $item->name !!}</td>
                            <td>{!! $item->code !!}</td>
                            <td> 
                                {{ $item->per_amt }}( {{ $item->type }}) <br>
                                Min Amt : ₹ {{ $item->stock_value }}<br>
                                Expiry Date : {{ $item->end_date }}
                            </td>
                            <td>{{ $item->coupon_label }}</td>
                            <td>{{ $item->coupon_count }}</td>
                            <td>
                              <div class="form-group">
                                <div class="custom-control custom-switch @if($item->status) {!! 'custom-switch-off-success custom-switch-on-danger' !!} @else  {!! 'custom-switch-on-success custom-switch-off-danger' !!} @endif couponStatus" id="{{ $item->id }}">
                                  <input type="checkbox" class="custom-control-input" id="couponstatus{{$item->id}}"/>
                                  <label class="custom-control-label" for="couponstatus{{$item->id}}"></label>
                                </div>
                              </div>
                            </td>
                            <td>
                              <a href="{{ url('/admin/coupon/' . $item->id . '/edit') }}" title="Edit "><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                &nbsp
                              <div class="btn-group">
                                <form method="DELETE" action="{{url('admin/coupon')}}" style="display:inline">
                                 @csrf
                                 <button type="button" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Warning! This will delete the coupon(If Any), Continue ?')" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                </form>
                               
                                
                               
                                </div>  
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
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
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(".couponStatus").on('change',function() { 
       var id = $(this).attr('id');
       $.ajax({
            type: "POST",
            url: "coupon-status",
            headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
            data: {
                id: id
            },
            success: function (msg) {
                 // alert(msg);
            }
        });
   });
  })
</script>
@endsection