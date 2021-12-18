@extends('layouts.admin')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class=""> Product Bulk Upload
                    </h4>
                    <p class="opacity-75 ">
                        A product is identified by Category , Sub Category or other attributes.
                        <br>
                       Please input all fields to show a product on website. 
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container  pull-up">
        <div class="row">
            <div class="col-lg-12">    
               <!--widget card begin-->
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">
                            Product Bulk Upload
                        </h5>                        
                    </div>
				<form class="form-horizontal" method="post" action="{{url('admin/product/upload')}}" enctype="multipart/form-data">
				@csrf
                    <div class="card-body "> 
					   <div class="form-row">
							<div class="col-4 form-group ">
                            <label>Upload File</label>
                            <input type="file" class="form-control" name="products"  required>
							<a href="{{url('admin/product/export-product-format')}}">Click Here To Download Sample</a>
                        </div> 	
						<div class="form-group col-10">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
					</form>
                </div> 		
             </div>
        </div>
    </div>
</section>
@endsection
