@extends('layouts.admin')
@section('content')
<script type="text/javascript" src="{{url('public/js/nicEdit-latest.js')}}"></script>
</script> <script type="text/javascript">
   //<![CDATA[
           bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
     //]]>
</script>
<section class="admin-content">
   <div class="bg-dark">
      <div class="container  m-b-30">
         <div class="row">
            <div class="col-12 text-white p-t-40 p-b-90">
               <h4 class=""> Product
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
                     Product 
                      <div class="pull-right"><a href="{{url('admin/product/list')}}" class="btn btn-primary add-more-info">Product List</a></div>
                  </h5>
               </div>
               <form class="form-horizontal" method="post" action="{{url('admin/product/save')}}" enctype="multipart/form-data">
                  @csrf
                  <?php
                  $p=0;
                  $gsts=array('0'=>'GST 0%','3'=>'GST 3%','5'=>'GST 5%','12'=>'GST 12%','18'=>'GST 18%','28'=>'GST 28%');
                  $gallery=$pdetails=array();
                  if($product->gallery){
                     $gallery=json_decode($product->gallery,true);
                  }
                  $pdetails=$product->pDetails;
                  // if($product->details){
                  //    $pdetails=json_decode($product->details,true);
                  // }

                  // dd($pdetails);
                  ?>
                  <input type="hidden" name="cat_id" value="{{$cat->id}}">
                  <input type="hidden" name="id" value="{{$product->id}}">
                  <div class="card-body ">
                     <div class="form-row">
                        <div class="col-4 form-group ">
                           <label>Sub Category</label>
                           <select class="form-control js-select2" name="scat_id" id="scat_id" required>
                              <option value="">Choose Sub Category</option>
                              @foreach ($subcats as $subcat)
                              @if($subcat->id==$product->scat_id)
                              <option value="{{ $subcat->id }}" selected>{{ $subcat->name}}</option>
                              @else
                              <option value="{{ $subcat->id }}">{{ $subcat->name}}</option>
                              @endif
                              @endforeach
                           </select>
                        </div>
                        <div class="col-4 form-group ">
                           <label>SKU Code</label>
                           <input type="text" class="form-control" name="sku" placeholder="SKU Code" value="{{$product->sku??''}}" required>
                        </div>
                        <div class="col-4 form-group ">
                           <label>Product Name</label>
                           <input type="text" class="form-control" name="name" placeholder="Product Name" value="{{$product->name??''}}" required>
                        </div>
                        <div class="col-4 form-group ">
                           <label>HSN Code</label>
                           <input type="text" class="form-control" name="hsn_code" placeholder="HSN Code " value="{{$product->hsn_code??''}}"  required>  
                        </div>
                        <div class="col-4 form-group ">
                           <label>GST%</label>
                           <select name="gst" id="gst" class="form-control" required onchange="calculaterealprice(this.value)">
                              <option value="">Select GST Slab</option>
                              @foreach($gsts as $k=>$gst)
                              @if($product->gst==$k)
                              <option value="{{$k}}" selected>{{$gst}}</option>
                              @else
                              <option value="{{$k}}">{{$gst}}</option>
                              @endif
                              @endforeach
                           </select>
                        </div>
                        
                        
                        <div class="col-4 form-group ">
                           <input type="checkbox" name="is_home" class="stockcheckbox" value="1" style="float: none; margin: 41px 6px 0px 20px;" @if($product->is_home) checked @endif>
                           Show Product On Home 
                           <input type="checkbox" name="is_exclusive" class="stockcheckbox" value="1" style="float: none; margin: 41px 6px 0px 20px;" @if($product->is_exclusive) checked @endif>
                           Exclusive Product
                        </div>
                        @if(isset($brands) && $brands)
                        <div class="col-4 form-group ">
                           <label>Brand</label>
                           <select class="form-control js-select2" name="brand"  required>
                              <option value="">Select Brand</option>
                              @foreach ($brands as $brand)
                              @if($product->brand==$brand->name)
                              <option value="{{ $brand->name }}" selected>{{ $brand->name}}</option>
                              @else
                              <option value="{{ $brand->name }}">{{ $brand->name}}</option>
                              @endif
                              @endforeach
                           </select>
                        </div>
                        @endif
                        @if(isset($occasions) && $occasions)
                        <div class="col-4 form-group ">
                           <label>Occasion</label>
                           <select class="form-control js-select2" name="occasion">
                              <option value="">Select Occasion</option>
                              @foreach ($occasions as $oc)
                              @if($product->occassion==$oc->name)
                              <option value="{{ $oc->name }}" selected>{{ $oc->name}}</option>
                              @else
                              <option value="{{ $oc->name }}">{{ $oc->name}}</option>
                              @endif
                              @endforeach
                           </select>
                        </div>
                        @endif
                        @if(isset($fabrics) && $fabrics)
                        <div class="col-4 form-group ">
                           <label>Fabric</label>
                           <select class="form-control js-select2" name="fabric" >
                              <option value="">Select Fabric</option>
                              @foreach ($fabrics as $oc)
                              @if($product->fabric==$oc->name)
                              <option value="{{ $oc->name }}" selected>{{ $oc->name}}</option>
                              @else
                              <option value="{{ $oc->name }}">{{ $oc->name}}</option>
                              @endif
                              @endforeach
                           </select>
                        </div>
                        @endif
                        @if(isset($designs) && $designs)
                        <div class="col-4 form-group ">
                           <label>Design</label>
                           <select class="form-control js-select2" name="design">
                              <option value="">Select Design</option>
                              @foreach ($designs as $oc)
                              @if($product->design==$oc->name)
                              <option value="{{ $oc->name }}" selected>{{ $oc->name}}</option>
                              @else
                              <option value="{{ $oc->name }}">{{ $oc->name}}</option>
                              @endif
                              @endforeach
                           </select>
                        </div>
                        @endif
                        @if(isset($materials) && $materials)
                        <div class="col-4 form-group ">
                           <label>Material</label>
                           <select class="form-control js-select2" name="material">
                              <option value="">Select Material</option>
                              @foreach ($materials as $oc)
                              @if($product->material==$oc->name)
                              <option value="{{ $oc->name }}" selected>{{ $oc->name}}</option>
                              @else
                              <option value="{{ $oc->name }}">{{ $oc->name}}</option>
                              @endif
                              @endforeach
                           </select>
                        </div>
                        @endif
                        @if(isset($patterns) && $patterns)
                        <div class="col-4 form-group ">
                           <label>Pattern</label>
                           <select class="form-control js-select2" name="pattern">
                              <option value="">Select Pattern</option>
                              @foreach ($patterns as $pt)
                              @if($product->pattern==$pt->name)
                              <option value="{{ $pt->name }}" selected>{{ $pt->name}}</option>
                              @else
                              <option value="{{ $pt->name }}">{{ $pt->name}}</option>
                              @endif
                              @endforeach
                           </select>
                        </div>
                        @endif
                        <div class="row" id="product-append">
                           <div class="col-12 form-group ">
                              <h4>Product Details
                                 <div class="pull-right"><a href="javascript:;" class="btn btn-primary add-more-info">Add More</a></div>
                              </h4>
                           </div>
                           @if($pdetails && $pdetails->count())
                           @foreach($pdetails as $pdetail)
                          
                           <div class="product-detail-con row col-12">
                              <input type="hidden" name="product[{{$p}}][id]" value="{{$pdetail->id??0}}">
                           <div class="col-4 form-group ">
                              <label>Size</label>
                              <select class="form-control js-select2" name="product[{{$p}}][size]" required>
                                 <option value="">Select Size</option>
                                 @foreach ($sizes as $si)
                                 @if(isset($pdetail['size']) && $pdetail['size']==$si->id)
                                 <option value="{{ $si->id }}" selected>{{ $si->name}} ({{$si->size}})</option>
                                 @else
                                 <option value="{{ $si->id }}">{{ $si->name}} ({{$si->size}})</option>
                                 @endif
                                 @endforeach
                              </select>
                           </div>
                           
                           <div class="col-4 form-group ">
                              <label>Color</label>
                              <select class="form-control  js-select2"  name="product[{{$p}}][colors]"  required>
                                 <option value="">Select Color</option>
                                 @foreach ($colors as $col)
                                 @if(isset($pdetail['color']) && $pdetail['color']==$col->id)
                                 <option value="{{ $col->id }}" selected>{{ $col->name}}</option>
                                 @else
                                 <option value="{{ $col->id }}">{{ $col->name}}</option>
                                 @endif
                                 @endforeach
                              </select>
                           </div>
                           
                           <div class="col-2 form-group">
                              <label>Quantity</label>
                              <input type="number" min="0" class="form-control"  name="product[{{$p}}][quantity]" value="{{$pdetail['quantity']??0}}" required>
                           </div>
                           <div class="col-2 form-group">
                              <label>Price(INR)</label>
                              <input type="number" min="0" class="form-control"  name="product[{{$p}}][inr_price]" value="{{$pdetail['inr_price']??0}}" required> 
                           </div>
                           <div class="col-2 form-group">
                              <label>Sell Price(INR)</label>
                              <input type="number" min="0" class="form-control" name="product[{{$p}}][inr_sell_price]" value="{{$pdetail['inr_sell_price']??0}}"> 
                           </div>
                           <div class="col-2 form-group">
                              <label>Price(USD)</label>
                              <input type="number" min="0" class="form-control"  name="product[{{$p}}][usd_price]" value="{{$pdetail['usd_price']??0}}" required> 
                           </div>
                           <div class="col-2 form-group">
                              <label>Sell Price(USD)</label>
                              <input type="number" min="0" class="form-control" name="product[{{$p}}][usd_sell_price]" value="{{$pdetail['usd_sell_price']??0}}"> 
                           </div>
                           @if($p>0)
                           <div class="col-2 form-group">
                               <div class="pull-right"><a href="javascript:;" class="btn btn-danger remove-info-cont">Remove</a>
                               </div>
                           </div>
                           @endif
                           <?php $p+=1;?>
                           <hr>
                           </div>
                           @endforeach
                           @endif
                        </div>
                     </div>
                     
                     <div class="form-row">
                        <div class="col-4 form-group ">
                           <label>Front Image</label>
                           <input type="file" name="image" class="form-control"> 
                           <br>
                           <div id="frontImg">
                              <img src="{{$product->image_url}}" width="100" height="100">
                           </div> 
                        </div>
                        <div class="col-8 form-group input_fields_container">
                           <label>Add More Images (Select Multiple Images)</label>
                           <input type="file" name="gallery[]" multiple class="form-control" > 
                           <br>
                           <div id="galleryImg" class="row">
                              @if($gallery && is_array($gallery))
                              @foreach($gallery as $k=>$gal)
                              <div class="remove-gallery-img" d-file="{{$gal}}" id="gallery{{$k}}" rel="{{$k}}">
                                 <input type="hidden" name="sgallery[]" value="{{$gal}}"><i class="fa fa-trash"></i>
                              <img src="{{productGalleryThumbnail($gal)}}" >
                              </div>
                              @endforeach
                              @endif
                           </div>
                           <!-- <div id="formdiv">
               <h4 class="theme-color">Multiple Image Upload <sup> * </sup></h4>
                  Atleast one image is required and Only JPEG,PNG,JPG Type Image format accepted.
                  <hr/>
                              
                  <input type="button" id="add_more" class="upload" value="Add More Files"/>
            
            <br/>
            </div> -->
                        </div>
                           
                        <div class="col-12 form-group ">
                           <label>Description</label>
                           <textarea name="description" id="shortdes" class="form-control">{!! $product->description !!}</textarea>
                        </div>
                        <div class="col-12 form-group ">
                           <label>Product Description</label>
                           <textarea name="p_description" id="myArea" rows="10" class="form-control">{!! $product->p_description !!}</textarea>
                        </div>
                        <div class="col-12 form-group ">
                           <label>Shipping</label>
                           <textarea name="shipping" id="shipping" class="form-control">{!! $product->shipping !!}</textarea>
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
@section('js-script')
<script type="text/javascript">
   $(document).ready(function () {
      var p="{{$p}}";
      $(document).on('click','.add-more-info',function(){
         p=Number(p);
         p=p+1;
         $('#product-append').append(`<div class="product-detail-con row col-12">
   <div class="col-4 form-group ">
      <input type="hidden" name="product[`+p+`][id]" value="0">
      <label>Size</label>
      <select class="form-control js-select2" name="product[`+p+`][size]" required>
         <option value="">Select Size</option>
         @foreach ($sizes as $si)
         <option value="{{ $si->id }}">{{ $si->name}} ({{$si->size}})</option>
         @endforeach
      </select>
   </div>
   <div class="col-4 form-group ">
      <label>Color</label>
      <select class="form-control  js-select2"  name="product[`+p+`][colors]"  required>
         <option value="">Select Color</option>
         @foreach ($colors as $col)
         <option value="{{ $col->id }}">{{ $col->name}}</option>
         @endforeach
      </select>
   </div>
   <div class="col-2 form-group">
         <label>Quantity</label>
         <input type="number" min="0" class="form-control"  name="product[`+p+`][quantity]" required>
   </div>
   <div class="col-2 form-group">
      <label>Price(INR)</label>
      <input type="number" min="0" class="form-control"  name="product[`+p+`][inr_price]" required> 
   </div>
   <div class="col-2 form-group">
      <label>Sell Price(INR)</label>
      <input type="number" min="0" class="form-control" name="product[`+p+`][inr_sell_price]" required> 
   </div>
   <div class="col-2 form-group">
      <label>Price(USD)</label>
      <input type="number" min="0" class="form-control"  name="product[`+p+`][usd_price]"> 
   </div>
   <div class="col-2 form-group">
      <label>Sell Price(USD)</label>
      <input type="number" min="0" class="form-control" name="product[`+p+`][usd_sell_price]"> 
   </div>
   <div class="col-2 form-group">
       <div class="pull-right"><a href="javascript:;" class="btn btn-danger remove-info-cont">Remove</a>
       </div>
   </div>
   <hr>
</div>`);
         $(".js-select2").select2({
});
      });
      $(document).on('click','.remove-info-cont',function(){
         $(this).closest(".product-detail-con").remove();
      })
   var csrf_token = '{{csrf_token()}}';
   var siteurl="{{url('/')}}"
      $(document).on('click','.remove-gallery-img',function(){
         var id=$(this).attr('rel');
         var file = $(this).attr('d-file');
        var data = {_token: csrf_token,file:file, ftype:'productGallery'};
        $.ajax({
            url: siteurl+'/config/img-delete',
            data: data,
            method: 'post',
            success: function (data, status, xhr) {
               console.log(data); 
               if(data.status==1){
                  $('#gallery'+id).remove();
               }
            },
            failure: function (status) {
                console.log(status);
            }
        });
      });
    /*bkLib.onDomLoaded(function() {
          new nicEditor({fullPanel : true, maxHeight:100}).panelInstance('myArea');
          new nicEditor({fullPanel : true, maxHeight:100}).panelInstance('shortdes');
          new nicEditor({fullPanel : true, maxHeight:100}).panelInstance('shipping');
          $('.nicEdit-panelContain').parent().width('100%');
          $('.nicEdit-panelContain').parent().next().width('98%');
          $('.nicEdit-main').width('100%');
          });*/
   $(".stockcheckbox").click(function(){
      var id=$(this).val();
         if($(this).is(':checked'))
      {
         $("#"+id).prop("disabled", false);
         $("#"+id).prop('required',true);
      }
      else
      {
         $("#"+id).prop("disabled", true);
         $("#"+id).prop('required',false);
         
      }
   
   
   });   
   
   $("#subcategory").change(function(){
   
   var id=$(this).val();
   $('#childcategory').empty();
   var formData = {subcategory_id:id, "_token": "{{ csrf_token() }}"}; //Array 
   
   $.ajax({
      url : "<?php echo url('get-child-category-by-subcategory');?>",
      type: "POST",
      data : formData,
      success: function(data, textStatus, jqXHR)
         {
            $('#childcategory').append(data);
         },
      error: function (jqXHR, textStatus, errorThrown)
         {
       
         }
   }); 
   
   
   });   
      
   });
</script>
<script>
   function calculaterealprice(gst)
   {
      var mrp=document.getElementById("mrp").value;
      var sellprice=document.getElementById("sell").value;
      
      if(sellprice>=1)
      {
         var gstamount=(sellprice/100)*gst;
         console.log(gstamount);
         document.getElementById("realprice").value=parseFloat(sellprice)-parseFloat(gstamount);
         
      }
      if(sellprice<1)
      {
         var gstamount=(mrp/100)*gst;
         console.log(gstamount);
         document.getElementById("realprice").value=parseFloat(mrp)-parseFloat(gstamount);
      }
      
      
      
   }
   
   
   function disc() {
            var txtFirstNumberValue = document.getElementById('mrp').value;
            var txtSecondNumberValue = document.getElementById('sell').value;
            var result = parseFloat(txtFirstNumberValue) - parseFloat(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('dis').value = result;
            }
        }
    
</script>
<script>
   $(document).ready(function() {
   var max_fields_limit      = 10; //set limit for maximum input fields
   var x = 1; //initialize counter for text box
   $('.add_more_button').click(function(e){ //click event on add more fields button having class add_more_button
       e.preventDefault();
       if(x < max_fields_limit){ //check conditions
           x++; //counter increment
           $('.input_fields_container').append('<div class="form-group"><input type="file" name="otherimages[]" class="form-control" /><a href="#" class="remove_field" style="margin-left:10px;">Remove</a></div>'); //add input field
       }
   });  
   $('.input_fields_container').on("click",".remove_field", function(e){ //user click on remove text links
       e.preventDefault(); $(this).parent('div').remove(); x--;
   })
   });
</script>

<script type="text/javascript">
    $('.number').keypress(function(event) {
      if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
        ((event.which < 48 || event.which > 57) &&
          (event.which != 0 && event.which != 8))) {
              alert('Please enter only number');
        event.preventDefault();
      }
    });
    
  /* $('.number').keypress(function(event) {
  if ((event.which < 48 || event.which > 57)) {
     alert('Please enter only number');
    event.preventDefault();
  }
});*/

    
     $('.decimal_number').keypress(function(event) {
      if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
        ((event.which < 48 || event.which > 57) &&
          (event.which != 0 && event.which != 8))) {
              alert('Please enter only decimal number');
        event.preventDefault();
      }
  
      var text = $(this).val();
  
      if ((text.indexOf('.') != -1) &&
        (text.substring(text.indexOf('.')).length > 2) &&
        (event.which != 0 && event.which != 8) &&
        ($(this)[0].selectionStart >= text.length - 2)) {
            alert('Please enter only decimal number');
        event.preventDefault();
      }
    });
</script>
<script type="text/javascript">
   var abc = 0; //Declaring and defining global increement variable

$(document).ready(function() {
var siteurl =  $('meta[name=siteurl]').attr('content');
var imgcount = 0;
//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('#add_more').click(function() {
        $(this).before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'file[]', type: 'file', id: 'file',class: 'file'+imgcount,style:'display:none'}),        
                $("")
                ));
            
      $('.file'+imgcount).trigger('click');
      
      $('body').on('click', '.file'+imgcount, function(){
         $(this).attr('id').trigger('change');        
      });
      imgcount = imgcount + 1;
    });

//following function will executes on change event of file input to select different file 
$('body').on('change', '#file', function(){
            if (this.files && this.files[0]) {
                 abc += 1; //increementing global variable by 1
            
            var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='abcd"+ abc +"' class='abcd col-md-4'><img id='previewimg" + abc + "' src=''/></div>");
               
             var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
               
             $(this).hide();
                $("#abcd"+ abc).append($("<img/>", {id: 'deletemultipleimgicon', src: siteurl+'/public/pluging/multipleimage/x.png', alt: 'delete'}).click(function() {
                $(this).parent().parent().remove();
                }));
            }
        });

      $('body').on('click', '#predeletemultipleimgicon', function(){
         $(this).parent().parent().remove();
      });
      
//To preview image     
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    
});
</script>
@endsection