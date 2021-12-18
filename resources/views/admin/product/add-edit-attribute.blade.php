@extends('layouts.admin')
@section('content')
<section class="admin-content">
    <div class="bg-dark">
        <div class="container  m-b-30">
            <div class="row">
                <div class="col-12 text-white p-t-40 p-b-90">
                    <h4 class=""> Attribute Mapping
                    </h4>
                    <p class="opacity-75 ">
                       Attribute mapping is used to map the desired Attribute to any category..
                        <br>
                        Create Attribute Mapping here.
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
                            Attribute Mapping
                            <div class="pull-right">
								<a href="{{url('admin/product/map-attribute')}}" class="btn btn-primary">
					  			Mapped Attribute List
								</a>
                        	</div>
                        </h5>
                    </div>
                	<form class="form-horizontal" method="post" action="{{url('admin/product/map-attribute/save')}}" enctype="multipart/form-data">
                	@csrf
                	<?php
	                $sts=array('1' =>'Active' ,'0'=>'In Active' );
	                $ssize=$scolor=$scolor=$sbrand=$spattern=$soccasion=$sfabric=$sdesign=$smaterial=array();
	                if(isset($attribute->id)){
	                	if($attribute->is_size && $attribute->sizes){
	                		$ssize=json_decode($attribute->sizes,true);
	                	}
	                	if($attribute->is_color && $attribute->colors){
	                		$scolor=json_decode($attribute->colors,true);
	                	}
	                	if($attribute->is_brand && $attribute->brands){
	                		$sbrand=json_decode($attribute->brands,true);
	                	}
	                	if($attribute->is_pattern && $attribute->patterns){
	                		$spattern=json_decode($attribute->patterns,true);
	                	}
	                	if($attribute->is_occasion && $attribute->occasions){
	                		$soccasion=json_decode($attribute->occasions,true);
	                	}
	                	if($attribute->is_fabric && $attribute->fabrics){
	                		$sfabric=json_decode($attribute->fabrics,true);
	                	}
	                	if($attribute->is_design && $attribute->designs){
	                		$sdesign=json_decode($attribute->designs,true);
	                	}
	                	if($attribute->is_material && $attribute->materials){
	                		$smaterial=json_decode($attribute->materials,true);
	                	}
	                }
	                ?>
                	<input type="hidden" name="id" value="{{$attribute->id??0}}">
                    <div class="card-body ">
                        <div class="form-row">
                         	<div class="form-group col-md-12">
                            	<label>Select Category</label>
                            	<select name="cat_id" id="cat_id" class="form-control" required>
	                            	<option value="">Select Category</option>
	                            	@foreach($cats as $cat)
	                            	@if(isset($attribute->cat_id) && $attribute->cat_id==$cat->id)
	                            	<option value="{{$cat->id}}" selected>{{$cat->name}}</option>
	                             	@else
	                             	<option value="{{$cat->id}}">{{$cat->name}}</option>
	                             	@endif
	                            	@endforeach
                            	</select>
                        	</div>
                      	</div> 
                <div class="form-row">
                 <div class="col-md-12">
                 <table class="table">
                   <tr>
                    <td colspan="3"><h6>Attribute's List</h6></td>
                   </tr>
                   <tr>
                        <td>
                        	<input type="checkbox" name="is_size" value="1" @if(isset($attribute->is_size) && $attribute->is_size) checked @endif> 
                        </td>
                        <td>Size: </td> 
                        <td>
                            <select name="sizes[]" class="form-control js-select2" multiple>
                            <option value="">Select Size Type</option>
                            @foreach($sizes as $sz)
                            <option value="{{$sz->id}}" @if(in_array($sz->id,$ssize)) selected @endif>{{$sz->name}} ({{$sz->size}})</option>
                            @endforeach
                            </select>
                        </td> 
                   </tr>
                   <tr>
                        <td><input type="checkbox" name="is_color" value="1" @if(isset($attribute->is_color) && $attribute->is_color) checked @endif> </td>
                        <td>Color </td> 
                        <td>
                            <select name="colors[]" class="form-control js-select2" multiple>
                            <option value="">Select Color Type</option>
                            @foreach($colors as $cl)
                            <option value="{{$cl->id}}" @if(in_array($cl->id,$scolor)) selected @endif>{{$cl->name}}</option>
                            @endforeach
                            </select>
                        </td> 
                   </tr>   
                   
                   <tr>
                        <td><input type="checkbox" name="is_brand" value="1" @if(isset($attribute->is_brand) && $attribute->is_brand) checked @endif></td>
                        <td>Brand </td> 
                        <td>
                            <select name="brands[]" class="form-control js-select2" multiple>
                            <option value="">Select Brand Type</option>
                            @foreach($brands as $brnd)
                            <option value="{{$brnd->id}}" @if(in_array($brnd->id,$sbrand)) selected @endif>{{$brnd->name}}</option>
                            @endforeach
                            </select>
                        </td> 
                   </tr> 
                   <tr>
                        <td><input type="checkbox" name="is_pattern" value="1" @if(isset($attribute->is_pattern) && $attribute->is_pattern) checked @endif> </td>
                        <td>Pattern </td> 
                        <td>
                            <select name="patterns[]" class="form-control js-select2" multiple>
                            <option value="">Select Pattern Type</option>
                            @foreach($patterns as $ptrn)
                            <option value="{{$ptrn->id}}" @if(in_array($ptrn->id,$spattern)) selected @endif>{{$ptrn->name}}</option>
                            @endforeach
                            </select>
                        </td> 
                   </tr> 
                   <tr>
                        <td><input type="checkbox" name="is_occasion" value="1" @if(isset($attribute->is_occasion) && $attribute->is_occasion) checked @endif> </td>
                        <td>Occasion </td> 
                        <td>
                            <select name="occasions[]" class="form-control js-select2" multiple>
                            <option value="">Select Occasion Type</option>
                            @foreach($occasions as $oc)
                            <option value="{{$oc->id}}" @if(in_array($oc->id,$soccasion)) selected @endif>{{$oc->name}}</option>
                            @endforeach
                            </select>
                        </td> 
                   </tr> 
                   <tr>
                        <td><input type="checkbox" name="is_fabric" value="1" @if(isset($attribute->is_fabric) && $attribute->is_fabric) checked @endif> </td>
                        <td>Fabric </td> 
                        <td>
                            <select name="fabrics[]" class="form-control js-select2" multiple>
                            <option value="">Select Fabrics</option>
                            @foreach($fabrics as $fbr)
                            <option value="{{$fbr->id}}" @if(in_array($fbr->id,$sfabric)) selected @endif>{{$fbr->name}}</option>
                            @endforeach
                            </select>
                        </td> 
                   </tr> 
                   <tr>
                        <td><input type="checkbox" name="is_design" value="1" @if(isset($attribute->is_design) && $attribute->is_design) checked @endif> </td>
                        <td>Design </td> 
                        <td>
                            <select name="designs[]" class="form-control js-select2" multiple>
                            <option value="">Select Design</option>
                            @foreach($designs as $ds)
                            <option value="{{$ds->id}}" @if(in_array($ds->id,$sdesign)) selected @endif>{{$ds->name}}</option>
                            @endforeach
                            </select>
                        </td>
                   </tr> 
                   <tr>
                        <td><input type="checkbox" name="is_material" value="1" @if(isset($attribute->is_material) && $attribute->is_material) checked @endif> </td>
                        <td>Material </td> 
                        <td>
                            <select name="materials[]" class="form-control js-select2" multiple>
                            <option value="">Select Material</option>
                            @foreach($materials as $mt)
                            <option value="{{$mt->id}}" @if(in_array($mt->id,$smaterial)) selected @endif>{{$mt->name}}</option>
                            @endforeach
                            </select>
                        </td> 
                   </tr>
                 </table>                   
                 </div>   
                </div>                        
                <div class="form-row">
			        <div class="form-group col-12">
			            <label>Status</label>
			            <select name="status" id="status" class="form-control">
			            	@foreach($sts as $key=>$st)
			            	@if(isset($attribute->id) && $attribute->status==$key)
			            	<option value="{{$key}}" selected>{{$st}}</option>
			            	@else
			            	<option value="{{$key}}">{{$st}}</option>
			            	@endif
			            	@endforeach
			            </select>
			        </div>   
			    </div>                                    
                <div class="form-group">
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