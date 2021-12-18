@extends('layouts.admin')
@section('content')
<section class="admin-content">
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">
                <h4 class=""> Size
                </h4>
                <p class="opacity-75 ">
                    There are a large variety of products from different categories.
                    <br>
                    Here you are able to make those categories which are not available on portal.
                </p>
            </div>
        </div>
    </div>
</div>
    <div class="container  pull-up">
        <div class="row">	
            <div class="col-lg-12">
                <!--widget card begin-->
                <div class="col-md-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                           Size
                           <!-- Button trigger modal -->
                            <div class="pull-right">
                            	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEditModal">
						  		Add Size
								</button>
                            </div>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover ">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Size</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
									@foreach ($lists as $list)
									<tr>
									<td>{{ $list->name}}</td>
									<td>{{ $list->size}}</td>
									<td>@if($list->status) <span class="text text-success">Active</span> @else <span class="text text-danger">In Active</span> @endif</td>
									<td>
									
									 <a href="javascript:;" data-id="{{$list->id}}" class="btn edit-data-btn btn-primary"> Edit</a>
									 <a href="javascript:;" data-id="{{$list->id}}" class="btn btn-danger delete-data-btn"> Delete</a>
								</td>
									</tr>
									@endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
            </div>
        </div>
    </div>
</section>
<!-- Add Edit Modal -->
<div class="modal fade" id="addEditModal" tabindex="-1" role="dialog" aria-labelledby="addEditModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEditModalLabel">Add Size</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    	<form  method="post" action="{{url('admin/product/config/size/save')}}" enctype="multipart/form-data">
		@csrf
		<input type="hidden" name="id" id="id" value="0">
      <div class="modal-body">
       	<div class="form-row">
             <div class="form-group col-12">
                <label>Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
            </div>   
        </div>  
        <div class="form-row">   
          	<div class="form-group col-12">
             	<label>Size</label>
                <input type="text" class="form-control" name="size" id="size" placeholder="Size">      
            </div>							   
        </div>
        <div class="form-row">
             <div class="form-group col-12">
                <label>Status</label>
                <select name="status" id="status" class="form-control">
                	<option value="1">Active</option>
                	<option value="0"> In Active</option>
                </select>
            </div>   
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
  	</form>
    </div>
  </div>
</div>
@endsection
@section('js-script')
<script>
$(document).ready(function () {
    var csrf_token = '{{csrf_token()}}';
    var siteurl="{{url('admin/product/config/size')}}"
	$(document).on("click", ".edit-data-btn", function () {
        var id = $(this).data('id');
        var data = {_token: csrf_token, id: id};
        $.ajax({
            url: siteurl+'/edit',
            data: data,
            method: 'post',
            success: function (data, status, xhr) {
				$('#addEditModalLabel').text('Edit Size');
				console.log(data);
                if (data.status == 1) {
                    var result = data.data;
                    $("#name").val(result.name);
                    $("#id").val(result.id);
                    $("#status").val(result.status);
                    $("#size").val(result.size);
                    $("#addEditModal").modal({
						 backdrop: 'static',
						 keyboard: false
					});
                } else {
                    swal({
				        title: "Warning",
				        text: data.message,
				        type: "warning",
				        timer: 3000,
				        showConfirmButton: false
				    });             
                }
            },
            failure: function (status) {
                console.log(status);
            }
        });
		return false;

    });
	
	
    $(document).on("click", ".delete-data-btn", function () {
        if (confirm("Deleting Selected Data! Are you sure?")) {
            var id = $(this).data('id');
            deleteData(id);
        }
    });
    function deleteData(pid) {
        var data = {_token: csrf_token, id: pid};
        $.ajax({
            url: siteurl+'/delete',
            data: data,
            method: 'post',
            success: function (data, status, xhr) {
                if (data.status == 1) {
                	swal({
				        title: "Success",
				        text: data.message,
				        type: "success",
				        timer: 3000,
				        showConfirmButton: false
				    });
                	setTimeout(function () {
                        window.location.reload();
                   	}, 3000);
                } else {
                   swal({
				        title: "Warning",
				        text: data.message,
				        type: "warning",
				        timer: 3000,
				        showConfirmButton: false
				    }); 
                }
            },
            failure: function (status) {
                console.log(status);
            }
        });
    }
});

</script>
@endsection