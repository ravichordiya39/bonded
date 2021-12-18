@extends('layouts.admin')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">

                    <h4 class=""> Product List
                    </h4>
                    <p class="opacity-75 ">
                        Examples for form control styles, layout options, and custom components for
                        creating a wide variety of forms elements.
                        <br>
                        we have included dropzone for file uploads, datepicker and select2 for custom controls.
                    </p>


                </div>
            </div>
        </div>
    </div>
        <div class=" pull-up">
            <div class="row">
                <div class="col-lg-12">
                    <!--widget card begin-->
                    <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-3 m-auto mb-1">
                                    <h5 class="m-b-0">
                                        <i class="mdi mdi-checkbox-intermediate"></i> Product List
                                    </h5>
                                </div>

                                <!-- {{--<div class="col-sm-6 m-auto mt-1">
                                    <div class="row text-center">
                                        <div class="col-md-5 mt-1">
                                            <select class="form-control" name="search_type" id="search_type">
                                                <option value="" selected="" disabled="">Select By:</option>
                                                <option value="0">Category</option>
                                                <option value="1">Sub Category</option>
                                                <option value="2">Name</option>
                                                <option value="5">MRP</option>
                                            </select>
                                        </div>
                                        <div id="cat_name_div"  class="col-md-7 mt-1 d-none">
                                            <select class="form-control" name="cat_name" id="cat_name"  onchange="myFunction()">
                                                <option value="" selected="" disabled="">Search by Category:</option>
                                                @if($cats)
                                                    @foreach($cats as $category)
                                                        <option value="{{$category->category}}">{{$category->category}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div id="subcat_name_div" class="col-md-7 mt-1 d-none">
                                            <select class="form-control" name="subcat_name" id="subcat_name"  onchange="myFunction()">
                                                <option value="" selected="" disabled="">Search by Sub Category:</option>
                                                @if($subcats)
                                                    @foreach($subcats as $sub_category)
                                                        <option value="{{$sub_category->subcategory}}">{{$sub_category->subcategory}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div id="product_name_div" class="col-md-7 mt-1 d-none">
                                            <input class="form-control" type="text" id="product_name" onkeyup="myFunction()" placeholder="Search for product.." title="Type in a name">
                                        </div>
                                    </div>
                                </div>--}} -->

                                <div class="col-sm-3 text-center m-auto mt-1">
                                     <h5 class="m-b-0">
                                        <a href="{{url('admin/product/add')}}" class="btn  btn-primary"> Add Product</a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table id="myTable" class="table table-hover ">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
										<th>Category</th>
										<!--<th>Sub Category</th>-->
										<th>Brand</th>
										<th>SKU</th>
										<th>Status</th>
										<th>Action</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
									   @foreach($lists as $list)
									   <tr>
									   		<td>{{$list->name}}</td>
									   		<td><img src="{{$list->thumbnail_url}}"></td>
									     	<td>{{$list->cat_name}}</td>
									     	<!--<td></td>-->
									     	<td>{{$list->brand}}</td>
									     	<td>{{$list->sku}}</td>
											<td>@if($list->status) <span class="text text-success">Active</span> @else <span class="text text-danger">In Active</span> @endif</td>
									     <td>
									        @if($list->status==1)
									        <a href="javascript:;" data-id="{{$list->id}}" status="0" class="btn  btn-warning data-status"> In Active</a>
									        @else
									    	<a href="javascript:;" data-id="{{$list->id}}" status="1" class="btn  btn-success data-status"> Active</a>
									        @endif
										 	<!-- <a href="javascript:;" class="btn  btn-primary"> View</a> -->
										  	<a href="{{url('admin/product/edit')}}/{{$list->id}}" class="btn  btn-primary"> Edit</a>
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
@endsection
@section('js-script')
<script>
    var search_type;
    $( document ).ready(function() {
        var csrf_token = '{{csrf_token()}}';
        var siteurl="{{url('admin/product')}}"
        $(document).on("click", ".data-status", function () {
            var id = $(this).data('id');
            var status=$(this).attr('status');
            var data = {_token: csrf_token, id: id,status:status};
            $.ajax({
                url: siteurl+'/status',
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
        $('select#search_type').on('change', function() {
            search_type = this.value
            if(search_type == 0){
                $("#cat_name_div").removeClass("d-none");
                $("#cat_name_div").addClass("d-block");

                $("#subcat_name_div").addClass("d-none");
                $("#subcat_name_div").removeClass("d-block");

                $("#product_name_div").addClass("d-none");
                $("#product_name_div").removeClass("d-block");
            }

            if(search_type == 1){
                $("#subcat_name_div").removeClass("d-none");
                $("#subcat_name_div").addClass("d-block");

                $("#product_name_div").addClass("d-none");
                $("#product_name_div").removeClass("d-block");

                $("#cat_name_div").addClass("d-none");
                $("#cat_name_div").removeClass("d-block");

            }

            if(search_type == 2 || search_type == 5){
                $("#product_name_div").removeClass("d-none");
                $("#product_name_div").addClass("d-block");

                $("#cat_name_div").addClass("d-none");
                $("#cat_name_div").removeClass("d-block");

                $("#subcat_name_div").addClass("d-none");
                $("#subcat_name_div").removeClass("d-block");

            }
            
        });
    });

    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      if(search_type == 0 || search_type == 1){
        if(search_type == 0){
            input = document.getElementById("cat_name");
        }
        if(search_type == 1){
            input = document.getElementById("subcat_name");
        }
      }else{
        input = document.getElementById("product_name");
      }
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[search_type];
        // td = tr[i].getElementsByTagName("td")[2];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
        // else{
        //     td = tr[i].getElementsByTagName("td")[0];
        //     if (td) {
        //       txtValue = td.textContent || td.innerText;
        //       if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //         tr[i].style.display = "";
        //       } else {
        //         tr[i].style.display = "none";
        //       }
        //     }
        // }     
      }
    }
</script>
@endsection
