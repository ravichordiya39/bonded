@extends('layouts.admin')
@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Customer List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
              <li class="breadcrumb-item active">Customer List</li>
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
            <h4>CUSTOMER REPORT</h4>
            <div class="tab-content" id="custom-content-below-tabContent">
              <div class="panel panel-default">
                <div class="panel-heading">
                 <div class="row">
                  <div class="col-md-3"> Total Filtered Records - <b><span id="total_records"></span></b></div>
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
                   <a class="btn btn-warning" href="{{ url('admin/reports/export-customer-data') }}">Export Customer Data</a>
                  </div>
                 </div>
                </div>
                <br>
              <div class="tab-pane fade show active" id="new-order" role="tabpanel" aria-labelledby="new-order-tab">
                 <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email Id</th>
                        <th>Phone</th>
                      </tr>
                </thead>
                <tbody>
                    @if(count($users))
    
                    <?php foreach($users as $key => $userList){ ?>
                        <tr>
                          <td>{{$userList->id}}</td>                                  
                          <td>{{$userList->name}}</td>                                  
                          <td>{{$userList->email}}</td>                                  
                          <td>{{$userList->phone}}</td>
                        </tr>
                      <?php } ?>

                    @else
                    <tr>
                        <td colspan="6" class="text-center">No Customer Found!</td>
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
   url:"fetch-customer-data",
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
     output += '<td>' + data[count].name + '</td>';
     output += '<td>' + data[count].email + '</td>';
     output += '<td>' + data[count].phone + '</td></tr>';
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

});
</script>
@endsection