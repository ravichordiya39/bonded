@extends('layouts.admin')
@section('content')
<section class="admin-content">
<div class="bg-dark">
    <div class="container  m-b-30">
        <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">
                <h4 class=""> Add Sub Categories in {{$category->name??''}}
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
                           Sub Categories
                           <!-- Button trigger modal -->
                            <div class="pull-right">
                            	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEditModal">
						  		Add Sub Category
								</button>
                            </div>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-hover ">
                                <thead>
                                <tr>
                                    <!-- <th>Image</th> -->
                                    <th>Sub Category</th>
                                    <th>Action</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
									@foreach ($subcats as $scat)
									<tr>
									<!-- <td><img src="{{$scat->thumbnail_url}}" width="60px"></td> -->
									<td>{{ $scat->name}}</td>
									<td>
									 <a href="javascript:;" data-id="{{$scat->id}}" class="btn edit-data-btn btn-primary"> Edit</a>
									 <a href="javascript:;" data-id="{{$scat->id}}" class="btn btn-danger delete-data-btn"> Delete</a>
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
        <h5 class="modal-title" id="addEditModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    	<form  method="post" action="{{route('save-product-category')}}" enctype="multipart/form-data">
		@csrf
		<input type="hidden" name="parent_id" id="parent_id" value="{{$category->id??0}}">
		<input type="hidden" name="id" id="id" value="0">
      <div class="modal-body">
       	<div class="form-row">
             <div class="form-group col-12">
                <label>Category</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Sub Category">
            </div>   
          </div>  
			<!-- <div class="form-row">
             <div class="form-group">
                <input type="checkbox"name="is_home" id="is_home" value="1" >&nbsp;&nbsp; Show on Home Page &nbsp; &nbsp; &nbsp;
                <input type="checkbox"name="is_menu" value="1" id="is_menu">&nbsp;&nbsp; Show in Menu
            </div>   
          </div> -->
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
    var siteurl="{{url('admin/category')}}"
	$(document).on("click", ".edit-data-btn", function () {
        var id = $(this).data('id');
        var data = {_token: csrf_token, id: id};
        $.ajax({
            url: siteurl+'/edit',
            data: data,
            method: 'post',
            success: function (data, status, xhr) {
				$('#addEditModalLabel').text('Edit Sub Category');
				console.log(data);
                if (data.status == 1) {
                    var result = data.data;
                    $("#name").val(result.name);
                    $("#id").val(result.id);
                    $("#parent_id").val(result.parent_id);
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