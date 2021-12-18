@extends($layout)
@section('content')
<section class="site-content">
    <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
            <div class="container-custom">
                <div class="page-banner-wrap">
                    <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                        <ul class="breadcrumb-items">
                            <li class="breadcrumb-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
                            <li class="breadcrumb-item trail-begin"><a href="{{url('product/list')}}" rel="home"><span itemprop="name">Product List</span></a></li>
                            @if(isset($category))
                            <li class="breadcrumb-item trail-begin"><a href="{{$category->url??'javascript:;'}}"><span>{{$category->name??''}}</span></a></li>
                            @endif
                            @if(isset($subcategory))
                            <li class="breadcrumb-item trail-begin"><a href="{{$subcategory->url??'javascript:;'}}"><span>{{$subcategory->name??''}}</span></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-banner-section -->
    <div class="content-wrapper">
        <div class="container-custom">
            @if(isset($category))
            <div class="page-header text-center">
                <h1 class="page-title">{{$category->name??''}}</h1>
            </div>
            @endif
            <div class="row flex-row-reverse">
                <div class="content-area col">
                    <div class="product-sortby-filter">
                        <p class="product-count">{{ $count }} Items</p>
                        <div class="sortby">
                            <!--<form id="myForm">-->
                            <div class="filter-dropdown dropdown">
                                <button class="filter-dropdown-title" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">Sort By</button>
                                <div class="filter-dropdown-menu dropdown-menu">
                                    <ul class="layer-filter size-filter">
                                        <li>
                                            <!--<input name="orderby" id="orderby" value="popularity" type="radio">-->

                                             <a href="<?php echo url()->current();?>?orderby=is_exclusive,DESC"><label for="price-desc">  Popularity </label> </a>
                                        </li>
                                        <li>
                                            <!--<input name="orderby" id="orderby" value="latest" type="radio">-->
                                                 <a href="<?php echo url()->current();?>?orderby=created_at,DESC"><label for="price-desc">  Latest </label> </a>
                                        </li>
                                        <li>
                                            <!--<input name="orderby" id="orderby" value="low_to_high" type="radio">-->
                                            <a href="<?php echo url()->current();?>?orderby=price,ASC"><label for="price-desc">  Price: low to high </label> </a>
                                        </li>
                                        <li>
                                            <!--<input name="orderby" id="orderby" value="high_to_low" type="radio">-->
                                            <a href="<?php echo url()->current();?>?orderby=price,DESC"><label for="price-desc">  Price: high to low </label> </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--</form>-->
                            <div class="product-display-mode">
                                <span id="grid" class="active"><a href="javascript:void(0);" title="3 Column"><i
                                            class="fas fa-th-large"></i></a></span>
                                <span id="grid_large"><a href="javascript:void(0);" title="4 Column"><i
                                            class="fas fa-th"></i></a></span>
                            </div>
                        </div>
                    </div>
                    <ul class="products columns-3" id="website">

                    </ul>
                    <div align="center" class="pagination" id="pagination_link">
                        <a href="javascript:void(0)"  data-div="#website"  class="load_more btn btn-light" data-start="" id="load_more">Load More</a>
                    </div>
                </div>
                <!--content-area-->
                @include('product.filter')
                <!--sidebar-section-->
            </div>
            <!--row-->
        </div>
        <!--content-wrapper -->
    </div>
    <!--container-->
</section>




@endsection
@section('js-script')
<script>
    $(document).on('change', '.checkbox', function() {
        filter_data(1);
    });
    $(document).ready(function(){
        filter_data(1);
        $(document).on('click', '.load_more', function(event){
            event.preventDefault();
            console.log($(this));
            // var page = $(this).data('start');
            var page=  $('#load_more').attr("data-start");
            var myString = page.split("=").pop();
            $div = $($(this).data('div'));
            filter_data(page);
            $div = $($(this).data('div'));
        });

        $("#productName").bind("click", function(e) {
            filter_data(1);
        })
        $(document).on('click', '.getcatId', function() {
          var subCatId =   $(this).attr('id');
            filter_data(1);
        })


    });
    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.colordfdf').click(function(){
        filter_data(1);
    });
    $('.catCheckBox').click(function(){
        filter_data(1);
    });
    function filter_data(page)
    {
        var action = 'fetch_data';
        var productName = $('#search-product').val();
        var cat = window.location.pathname;
        var cats = cat.split('/');
        var size = get_filter('size');
        var color = get_filter('color');
        var price = get_filter('price');
        var sorting =$('#sorting').val();
        var pricesorting =$('#price-sorting').val();
        var subCategegory = '';
        if (typeof cats[3] !== 'undefined') {
             subCategegory = cats[3];
        }

        if(page == 1) {
        var url = APP_URL+"/productlist/" + cats[2];
        }
        else{
        var url = page;
        }

        $.ajax({
            url:url,
            method:"POST",
            dataType:"JSON",
            data:{action:action,
                productName:productName,
                color:color,
                size:size,
                sorting:sorting,
                price:price,
                pricesorting:pricesorting,
                subCategegory:subCategegory,
                _token: "{{ csrf_token() }}"},
                success:function(response)
                {
                if(page == 1) {
                    $('#website').html(response.html);
                    if (response.next_page_url === null) {
                        $(".pagination").hide();
                    }
                    else{
                        $(".pagination").show();
                        $('#load_more').attr("data-start", response.next_page_url);
                    }
                }
                else{
                    $('#website').append(response.html);
                    if (response.next_page_url === null) {
                        $(".pagination").hide();
                    }
                    else{
                        $(".pagination").show();
                        $('#load_more').attr("data-start", response.next_page_url);
                    }
                }
            },
            async:false
        })
    }
</script>

@endsection
