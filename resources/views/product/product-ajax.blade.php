@if($products->count())
    @php
    $cType = checkCurrencySession();
    $column =$cType['column_name'];
    $sell_column =$cType['sell_column'];
    @endphp
    @foreach($products as $list)
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
                                        <img src="{{$list->thumbnail_url}}" alt="{{$list->name}}" class="main-image">
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
                                        <a href="javascript:void(0)" data-pdid="{{$list->pDetail->id}}" data-id="{{$list->id}}" class="add-cart-button">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h5 class="product-title">
                                        <a href="{{$list->url}}">{{$list->name}}</a>
                                    </h5>
                                    <div class="product-price">
                                        <span class="price"><span class="Price-currencySymbol">{{$cType['icon']}}</span>
                                        {{$sellp}}
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        @else
                        <li class="product-item product">
                            <div class="product-wrap">{{NotAvailable}}
                            </div>
                        </li>
                        @endif
