@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection
@section('content')
<section class="admin-content">

  <div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">
                <h4 class="">User List
                </h4>
                <p class="opacity-75 ">
                   User list here to show all users regitster with us
                    
                </p>
            </div>
        </div>
    </div>
</div>

    <!-- Main content -->
    <div class="container  pull-up">
      <div class="row">
        <div class="col-12">
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Users' &nbsp;</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Email</th>
                         <th>Mobile</th>
                         <th>Status</th>
                         <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $item)
                        <tr>                           
                           <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                              <div class="form-group">
                                <div class="custom-control custom-switch @if($item->status) {!! 'custom-switch-off-success custom-switch-on-danger' !!} @else  {!! 'custom-switch-on-success custom-switch-off-danger' !!} @endif userStatus" id="{{ $item->id }}">
                                  <input type="checkbox" class="custom-control-input" id="userStatus{{$item->id}}"/>
                                  <label class="custom-control-label" for="userStatus{{$item->id}}"></label>
                                </div>
                              </div>
                            </td>
                            <td>
                                <a href="{{ url('/admin/users/' . $item->id) }}" title="View User"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                {{--<a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'url' => ['/admin/users', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm',
                                            'title' => 'Delete User',
                                            'onclick'=>'return confirm("Confirm delete?")'
                                    )) !!}
                                {!! Form::close() !!} --}}
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
    </div>
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
    $(".userStatus").one('click',function() { 
       var id = $(this).attr('id');
       $.ajax({
            type: "POST",
            url: "user-status",
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