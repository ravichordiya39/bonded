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
               @if(isset($is_cat) && $is_cat)
               <div class="card-body ">
                  <div class="row">
                     @if($cats->count())
                     @foreach($cats as $cat)
                     <div class="col-md-3 categorydiv"> 
                     <a href="{{url('admin/product/add')}}/{{$cat->slug}}">
                        <img src="{{$cat->thumbnail_url}}">
                        <h3>{{$cat->name}}</h3>
                     </a>
                    </div>
                    @endforeach
                    @else
                    <h3>Add Category and Map with Attribute</h3>
                    @endif
                  </div>
               </div>
               @else
               <form class="form-horizontal" method="post" action="{{url('admin/product/save')}}" enctype="multipart/form-data">
                  @csrf
                  <?php
                  $gsts=array('0'=>'GST 0%','3'=>'GST 3%','5'=>'GST 5%','12'=>'GST 12%','18'=>'GST 18%','28'=>'GST 28%');
                  ?>
                  <input type="hidden" name="cat_id" value="{{$cat->id}}">
                  <div class="card-body ">
                     <div class="form-row">
                        <div class="col-4 form-group ">
                           <label>Sub Category</label>
                           <select class="form-control js-select2" name="scat_id" id="scat_id" required>
                              <option value="">Choose Sub Category</option>
                              @foreach ($subcats as $subcat)
                              <option value="{{ $subcat->id }}">{{ $subcat->name}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-4 form-group ">
                           <label>SKU Code</label>
                           <input type="text" class="form-control" name="sku" placeholder="SKU Code" value="{{old('sku')}}" required>
                        </div>
                        <div class="col-4 form-group ">
                           <label>Product Name</label>
                           <input type="text" class="form-control" name="name" placeholder="Product Name" value="{{old('name')}}"  required>
                        </div>
                        <div class="col-4 form-group ">
                           <label>HSN Code</label>
                           <input type="text" class="form-control" name="hsn_code" placeholder="HSN Code" value="{{old('hsn_code')}}" required>  
                        </div>
                        <div class="col-4 form-group ">
                           <label>GST%</label>
                           <select name="gst" id="gst" class="form-control" required onchange="calculaterealprice(this.value)">
                              <option value="">Select GST Slab</option>
                              @foreach($gsts as $k=>$gst)
                              <option value="{{$k}}">{{$gst}}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-4 form-group ">
                           <input type="checkbox" name="is_home" class="stockcheckbox" value="1" style="float: none; margin: 41px 6px 0px 20px;">
                           Show Product On Home
                           <input type="checkbox" name="is_exclusive" class="stockcheckbox" value="1" style="float: none; margin: 41px 6px 0px 20px;">
                           Exclusive Product
                        </div>
                        @if(isset($brands) && $brands)
                        <div class="col-4 form-group ">
                           <label>Brand</label>
                           <select class="form-control js-select2" name="brand"  required>
                              <option value="">Select Brand</option>
                              @foreach ($brands as $brand)
                              <option value="{{ $brand->name }}">{{ $brand->name}}</option>
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
                              <option value="{{ $oc->name }}">{{ $oc->name}}</option>
                              @endforeach
                           </select>
                        </div>
                        @endif
                        @if(isset($fabrics) && $fabrics)
                        <div class="col-4 form-group ">
                           <label>Fabric</label>
                           <select class="form-control js-select2" name="fabric"  required>
                              <option value="">Select Fabric</option>
                              @foreach ($fabrics as $oc)
                              <option value="{{ $oc->name }}">{{ $oc->name}}</option>
                              @endforeach
                           </select>
                        </div>
                        @endif
                        @if(isset($designs) && $designs)
                        <div class="col-4 form-group ">
                           <label>Design</label>
                           <select class="form-control js-select2" name="design"  required>
                              <option value="">Select Design</option>
                              @foreach ($designs as $oc)
                              <option value="{{ $oc->name }}">{{ $oc->name}}</option>
                              @endforeach
                           </select>
                        </div>
                        @endif
                        @if(isset($materials) && $materials)
                        <div class="col-4 form-group ">
                           <label>Material</label>
                           <select class="form-control js-select2" name="material" required>
                              <option value="">Select Material</option>
                              @foreach ($materials as $oc)
                              <option value="{{ $oc->name }}">{{ $oc->name}}</option>
                              @endforeach
                           </select>
                        </div>
                        @endif
                        @if(isset($patterns) && $patterns)
                        <div class="col-4 form-group ">
                           <label>Pattern</label>
                           <select class="form-control js-select2" name="pattern"  required>
                              <option value="">Select Pattern</option>
                              @foreach ($patterns as $pt)
                              <option value="{{ $pt->name }}">{{ $pt->name}}</option>
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
                           <input type="hidden" name="product[0][id]" value="0">
                           <div class="col-4 form-group ">
                              <label>Size</label>
                              <select class="form-control js-select2" name="product[0][size]" required>
                                 <option value="">Select Size</option>
                                 @foreach ($sizes as $si)
                                 <option value="{{ $si->id }}">{{ $si->name}} ({{$si->size}})</option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-4 form-group ">
                              <label>Color</label>
                              <select class="form-control  js-select2"  name="product[0][colors]"  required>
                                 <option value="">Select Color</option>
                                 @foreach ($colors as $col)
                                 <option value="{{ $col->id }}">{{ $col->name}}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="col-2 form-group">
                              <label>Quantity</label>
                              <input type="number" min="0" class="form-control"  name="product[0][quantity]" required>
                           </div>
                           <div class="col-2 form-group">
                              <label>Price(INR)</label>
                              <input type="number" min="0" class="form-control"  name="product[0][inr_price]" required> 
                           </div>
                           <div class="col-2 form-group">
                              <label>Sell Price(INR)</label>
                              <input type="number" min="0" class="form-control" name="product[0][inr_sell_price]" > 
                           </div>
                           <div class="col-2 form-group">
                              <label>Price(USD)</label>
                              <input type="number" min="0" class="form-control"  name="product[0][usd_price]" required> 
                           </div>
                           <div class="col-2 form-group">
                              <label>Sell Price $(USD)</label>
                              <input type="number" min="0" class="form-control" name="product[0][usd_sell_price]"> 
                           </div>
                        </div>
                        <hr>
                     </div>
                     
                     <div class="form-row">
                        <div class="col-4 form-group ">
                           <label>Front Image</label>
                           <input type="file" name="image" class="form-control" required> 
                           <br>
                           <div id="frontImg"></div> 
                        </div>
                        <div class="col-8 form-group input_fields_container">
                           <label>Add More Images (Select Multiple Images)</label>
                           <input type="file" name="gallery[]" multiple class="form-control" > 
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
                           <textarea name="description" id="shortdes" class="form-control">{{old('description')}}</textarea>
                        </div>
                        <div class="col-12 form-group ">
                           <label>Product Description</label>
                           <textarea name="p_description" id="myArea" rows="10" class="form-control">{{old('p_description')}}</textarea>
                        </div>
                        <div class="col-12 form-group ">
                           <label>Shipping</label>
                           <textarea name="shipping" id="shipping" class="form-control">{{old('shipping')}}</textarea>
                        </div>
                     </div>
                     <div class="form-group">
                        <button class="btn btn-primary">Submit</button>
                     </div>
                  </div>
               </form>
               @endif
            </div>
         </div>
      </div>
   </div>
</section>
@endsection
@section('js-script')
<script type="text/javascript">
   $(document).ready(function () {
      var p=0;
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