@extends($layout)
@section('content')
<section class="site-content">
    <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
            <div class="container-custom">
                <div class="page-banner-wrap">
                    <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                        <ul class="breadcrumb-items">
                            <li class="breadcrumb-item trail-begin"><a href="{{url('/')}}" rel="home"><span itemprop="name">Home</span></a></li>
                            <li class="breadcrumb-item trail-begin"><a href="{{url('product/list')}}" rel="home"><span itemprop="name">Product List</span></a></li>
                            <li class="breadcrumb-item trail-begin"><a href="{{$detail->cat->url??'javascript:;'}}" rel="home"><span itemprop="name">{{$detail->cat->name??''}}</span></a></li>
                            <li class="breadcrumb-item trail-begin"><a href="{{$detail->scat->url??'javascript:;'}}" rel="home"><span itemprop="name">{{$detail->scat->name??''}}</span></a></li>
                            <li class="breadcrumb-item trail-end"><span itemprop="name">{{$detail->name}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-banner-section -->
    <div class="content-wrapper">
        <div class="container-custom">
            <div class="content-area">
                <div id="product-[]" class="single-product">
                    <div class="single-product-details">
                        @php
                        $galleries=array();
                        if($detail->gallery){
                            $galleries=json_decode($detail->gallery);
                        }
                        
                        $pdetails=$detail->pDetails;
                        $cType = checkCurrencySession();
                        $column =$cType['column_name'];
                        $sell_column =$cType['sell_column'];
                        if(isset($pdetails->first()->$sell_column) && $pdetails->first()->$sell_column){
                            $price=$pdetails->first()->$column??'0';
                            $sellprice=$pdetails->first()->$sell_column??'0';
                        }else{
                            $price=$pdetails->first()->$column??'0';
                            $sellprice=$pdetails->first()->$column??'0';
                            }
                        $size=$pdetails->first()->size??'0';
                        $color=$pdetails->first()->color??'0';
                        $quantity=$pdetails->first()->quantity??'0';
                        $pdid=$pdetails->first()->id??'0';
                        $discount=0;
                       
                        if($price && $sellprice && $sellprice !=0){
                            $discount= getPriceDiffPercent($price,$sellprice);
                        }
                        $shared['url']=$detail->url;
                        $shared['image_url']=$detail->thumbnail_url;
                        $shared['title']=$detail->name;
                       
                        // dd($pdetails);
                        @endphp
                         
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="product-gallery">
                                    <div class="product-gallery-area product-gallery-with-images">
                                        <div class="onsale-trading">
                                            @if($detail->is_sale=='1')
                                            <div class="onsale-off">{{$discount}}% OFF</div>
                                            <span class="onsale">@if($detail->is_sale=='1')Sale!@endif</span>
                                            @else
                                            <span class="tranding">New</span>
                                            @endif
                                        </div>
                                        <div class="product-gallery-wrapper product-gallery-slider">
                                            <div class="product-gallery-image">
                                                <a data-fancybox="gallery" href="{{productGalleryOneThumbnail($detail->image)}}"><img src="{{productGalleryOneThumbnail($detail->image)}}" alt="{{$detail->image}}"></a>
                                            </div>
                                            @if($galleries && is_array($galleries))
                                            @foreach($galleries as $gal)
                                            <div class="product-gallery-image">
                                                <a data-fancybox="gallery" href="{{productGalleryImg($gal)}}"><img src="{{productGalleryImg($gal)}}" alt="{{$gal}}"></a>
                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                        <ol class="product-gallery-thumbs">
                                             @if($galleries && is_array($galleries))
                                             <li><img src="{{productGalleryOneThumbnail($detail->image)}}" alt="{{$detail->image}}"></li>
                                            @foreach($galleries as $gal)
                                           <li><img src="{{productGalleryImg($gal)}}" alt="{{$gal}}"></li>
                                            @endforeach
                                            @endif
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 pl-xl-5">
                                <div class="summary product-summary">
                                    <h1 class="product-single-title">{{$detail->name}}</h1>
                                    <p class="price">
                                        <span class="price">
                                            <del><span class="Price-amount amount"><span class="Price-currencySymbol">₹</span> <span id="inr_price"> {{$price}}</span></span></del>
                                            @if($sellprice)
                                            <span class="Price-amount amount"><span class="Price-currencySymbol">₹</span> <span id="inr_sell_price">{{$sellprice}}</span></span>
                                            @endif
                                        </span>
                                    </p>
                                    <div class="product-summary-cart">
                                        <form class="variations-form addcart" action="{{url('user/buy')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$detail->id}}">
                                            <input type="hidden" name="product_detail_id" id="product_detail_id" value="{{$pdid}}">
                                            <div class="product-summary-attribute">
                                                <div class="attribute-group">
                                                    <label>Sizes</label>
                                                    <select name="size" id="size" class="" title="">
                                                        @foreach($pdetails as $pdetail)
                                                       
                                                        @if($size && $size==$pdetail->sizeDetail->id)
                                                        <option value="{{$pdetail->size}}" selected>{{$pdetail->sizeDetail->size??''}}</option>
                                                        @else
                                                        <option value="{{$pdetail->size}}">{{$pdetail->sizeDetail->size??''}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="attribute-group">
                                                    <label>Color</label>
                                                    <select name="color" id="color" class="" title="">
                                                        @foreach($pdetails as $pdetail)
                                                           
                                                        @if($color && $color==$pdetail->colorDetail->id)
                                                        <option value="{{$pdetail->color}}" selected>{{$pdetail->colorDetail->name??''}}</option>
                                                        @else
                                                        <option value="{{$pdetail->color}}">{{$pdetail->colorDetail->name??''}}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="size-chart">
                                                    <a href="javascript:void(0);" class="size-chart-button"
                                                        data-target="#sizeModal" data-toggle="modal"
                                                        type="button"><i class="fas fa-chart-bar"></i> Size
                                                        Chart</a>
                                                    <div class="modal fade" id="sizeModal">
                                                        <div
                                                            class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal"
                                                                    aria-label="Close"><span
                                                                        aria-hidden="true">×</span></button>
                                                                <div class="modal-body">
                                                                    <table>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="86">Size</td>
                                                                                <td width="96">Bust (in)</td>
                                                                                <td width="97">Whist (in)</td>
                                                                                <td width="103">Length (in)</td>
                                                                                <td width="95">Hip (in)</td>
                                                                                <td width="163">Across Shoulder
                                                                                    (in)
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="86">S</td>
                                                                                <td width="96">38</td>
                                                                                <td width="97">34</td>
                                                                                <td width="103">56</td>
                                                                                <td width="95">39</td>
                                                                                <td width="163">14.5</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="86">M</td>
                                                                                <td width="96">40</td>
                                                                                <td width="97">36</td>
                                                                                <td width="103">56</td>
                                                                                <td width="95">41</td>
                                                                                <td width="163">15</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="86">L</td>
                                                                                <td width="96">42</td>
                                                                                <td width="97">38</td>
                                                                                <td width="103">56</td>
                                                                                <td width="95">43</td>
                                                                                <td width="163">15.5</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="86">XL</td>
                                                                                <td width="96">44</td>
                                                                                <td width="97">40</td>
                                                                                <td width="103">56</td>
                                                                                <td width="95">45</td>
                                                                                <td width="163">16</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="86">XXL</td>
                                                                                <td width="96">46</td>
                                                                                <td width="97">42</td>
                                                                                <td width="103">56</td>
                                                                                <td width="95">47</td>
                                                                                <td width="163">16.5</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <p>Garment Measurements in Inches</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wishlist-quantity-button">
                                                <div class="quantity">
                                                    <label for="quantity"> Quantity </label>
                                                    <div class="quantity-group">
                                                        <a href="javascript:void(0)" class="dec qty-btn"></a>
                                                        <input type="text" id="quantity" class="input-text qty"
                                                            name="quantity" value="1" maxlength="{{$quantity}}">
                                                        <a href="javascript:void(0)" class="inc qty-btn"></a>
                                                    </div>
                                                </div>
                                                <div class="single-wishlist-btn">
                                                    <a href="javascript:;" id="wish{{$detail->id}}" data-id="{{$detail->id}}" rel="nofollow"  class="@if(Auth::check() && Auth::user()->user_type=='user') @if($detail->isWished()) remove_to_wishlist @else add_to_wishlist @endif @else loginregister @endif single_add_to_wishlist"
                                                        title="Add to Wishlist">
                                                        @if(Auth::check() && Auth::user()->user_type=='user' && $detail->isWished())
                                                        <i class="far fa-heart"></i><span id="wishtext{{$detail->id}}">Remove from Wishlist</span>
                                                        @else
                                                        <i class="far fa-heart"></i><span id="wishtext{{$detail->id}}">Add to Wishlist</span>
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-summary-button">
                                            <a href="javascript:;" data-id="{{$detail->id}}" data-pdid="{{$pdid}}" class="add_to_cart_button btn button add-cart-button" id="add-to-cart">Add to Cart</a>
                                                    @if(Auth::check() && Auth::user()->user_type=='user')
                                                <button type="submit"
                                                    class="buy_now_button btn btn-secondary">Buy
                                                    Now</button>
                                                    @else
                                                    <button type="button"
                                                    class="buy_now_button btn btn-secondary loginregister">Buy
                                                    Now</button>
                                                    @endif
                                            </div>
                                        </form>
                                        <div class="product-share">
                                            <span>Share On : </span>
                                            @include('common.share')
                                        </div>
                                    </div>
                                    <div class="product-information">
                                        <ul class="nav single-product-tabs">
                                            <li><a class="active" data-toggle="tab"
                                                    href="#description">Description</a>
                                            </li>
                                            <li><a data-toggle="tab" href="#specification">Specification</a>
                                            </li>
                                            <li><a data-toggle="tab" href="#shipping">Shipping</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="description">
                                                <p><strong>Description</strong></p>
                                                <p>{!!$detail->description??'' !!}</p>
                                            </div>
                                            <div class="tab-pane fade" id="specification">
                                                <p><strong>Specification</strong></p>
                                                @if($detail->brand)
                                                <p><strong>Brand:</strong> {{$detail->brand}}</p>
                                                @endif
                                                @if($detail->occasion)
                                                <p><strong>Occasion:</strong> {{$detail->occasion}}</p>
                                                @endif
                                                @if($detail->fabric)
                                                <p><strong>Fabric:</strong> {{$detail->fabric}}</p>
                                                @endif
                                                @if($detail->pattern)
                                                <p><strong>Pattern:</strong> {{$detail->pattern}}</p>
                                                @endif
                                                @if($detail->design)
                                                <p><strong>Design:</strong> {{$detail->design}}</p>
                                                @endif
                                                @if($detail->material)
                                                <p><strong>Material:</strong> {{$detail->material}}</p>
                                                @endif
                                                <p>{!!$detail->p_description??'' !!}</p>
                                            </div>
                                            <div class="tab-pane fade" id="shipping">
                                                <p><strong>Shipping</strong></p>
                                                <p>{!!$detail->shipping??'' !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-help">
                                        <p class="help1"><strong>Need help placing your order?</strong></p>

                                        <a href="javascript:;" target="_blank">
                                            <i class="fab fa-whatsapp"></i> Call or WhatsApp us at {{$contact_phone->key_value??'+91-123456789'}}
                                        </a>
                                        <a href="mailto:care@abeerjaipur.com">
                                            <i class="far fa-envelope"></i> E-mail us at {{$contact_email->key_value??'care@abeerjaipur.com'}}
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="related-products">
                        <div class="section-header text-center">
                            <h2 class="section-title">Related Products</h2>
                        </div>
                        <ul class="products product-carousel columns-4">
                            @php
                            $cType = checkCurrencySession();
                          
                            $column =$cType['column_name'];
                            $sell_column =$cType['sell_column'];
                            @endphp
                            @foreach($rlists as $list)
                            @php
                                if(isset($list->pDetail->$sell_column) && $list->pDetail->$sell_column){
                                        $maxp=$list->pDetail->$column??0;
                                        $sellp=$list->pDetail->$sell_column??0;
                                    }else{
                                        $sellp=$list->pDetail->$column??0;
                                    }
                                @endphp
                            <li class="product-item product">
                                <div class="product-wrap">
                                    <div class="product-image">
                                        <div class="onsale-trading">
                                            <!-- <span class="tranding">New</span> -->
                                        </div>
                                        <a href="{{$list->url}}">
                                            <img src="{{$list->thumbnail_url}}" alt="" class="main-image">
                                        </a>
                                        <div class="product-wishlist wishlist">
                                            <a href="javascript:void(0)" rel="{{$list->id}}" data-id="{{$list->id}}" class="add-to-wishlist favourite">
                                                @if(isset($list->wishDetails))
                                                    @if($list->wishDetails->product_id == $list->id)
                                                    <i class="fa fa-heart" id="divcommenttextbox_{{$list->id}}"></i>
                                                    @endif
                                                @else
                                                    <i class="far fa-heart" id="divcommenttextbox_{{$list->id}}"></i>
                                                @endif
                                            </a>
                                        </div>
                                        <div class="product-cart-button">
                                            
                                            <a href="javascript:;" data-id="{{$list->id}}" data-pdid="{{$list->pDetail->id}}}"  class="add-cart-button">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h5 class="product-title">
                                            <a href="{{$list->url}}">{{$list->name}}</a>
                                        </h5>
                                        <div class="product-price">
                                            <span class="price"><span class="Price-currencySymbol">₹</span>
                                            {{$sellp}}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!--content-wrapper -->
    </div>
    <!--container-->
</section>

@endsection
@section('js-script')
<script type="text/javascript">
    $(document).ready(function(){
        var pconfig=[];
        var pCconfig=[];
        @foreach($pdetails as $k=>$pdetail)
            @php
            $cType = checkCurrencySession();
                          
            $column =$cType['column_name'];
            $sell_column =$cType['sell_column'];
            if(isset($pdetail->$sell_column) && $pdetail->$sell_column){
                $maxp=$pdetail->$column??0;
                $sellp=$pdetail->$sell_column??0;
                $price=$pdetail->$column??0;
            }else{
                $price=$pdetail->$column??0;
                $sellp=$pdetail->$sell_column??0;
            }
            @endphp
            var dt={size:'{{$pdetail->size}}',
                    id:'{{$pdetail->id}}',
                    color:'{{$pdetail->color}}',
                    inr_price:'{{$price}}',
                    inr_sell_price:'{{$sellp}}',
                    quantity:'{{$pdetail->quantity}}'};
                    pconfig['{{$pdetail->size}}']=dt;
                    pCconfig['{{$pdetail->color}}']=dt;
        @endforeach
        $(document).on('change','#size',function(){
            var size=$(this).val();
            var pdetail=pconfig[size];
            $('#inr_sell_price').text(pdetail.inr_sell_price);
            $('#inr_price').text(pdetail.inr_price);
            $('#quantity').text(pdetail.quantity);
            $('#add-to-cart').attr('data-pdid',pdetail.id);
            $('#product_detail_id').val(pdetail.id)
             //console.log(pconfig[size]);
        })
        $(document).on('change','#color',function(){
            var color=$(this).val();
            var pdetail=pCconfig[color];
            $('#inr_sell_price').text(pdetail.inr_sell_price);
            $('#inr_price').text(pdetail.inr_price);
            $('#quantity').text(pdetail.quantity);
            $('#add-to-cart').attr('data-pdid',pdetail.id);
            $('#product_detail_id').val(pdetail.id)
             //console.log(pdetail);
        })
    });
</script>

@endsection
