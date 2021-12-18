<div class="filter-sidebar sidebar widget-area col-lg-3 col-12">
	<?php
	$cats=\App\Models\Product\Category::where(['status'=>1,'parent_id'=>0])->orderby('name','asc')->get();
	$sizes=\App\Models\Product\Size::where(['status'=>1])->orderby('name','asc')->get();
	$colors=\App\Models\Product\Color::where(['status'=>1])->orderby('name','asc')->get();
	?>
    <h3 class="filter-sidebar-heading">
        Filter By
    </h3>
    <div class="widget-product-categories widget open">
        <h4 class="widget-title open">Categories</h4>
        <ul class="layer-filter product-categories">
        	@foreach($cats as $cat)
            <li><a href="{{$cat->url}}" data-url="{{$cat->url}}" class="@if(isset($category) && $category->id==$cat->id) active @endif">{{$cat->name}} ({{$cat->productCount()}})</a></li>
            @endforeach
        </ul>
    </div>
    <div class="widget-product-size widget">
        <h4 class="widget-title">Size</h4>
        <ul class="layer-filter size-filter">
            @foreach($sizes as $size)
            <li>
                <input name="size[]" class="checkbox size"  data-url="{{$cat->url}}" data-id="{{$size->id}}" id="size_s size" value="{{$size->id}}" type="checkbox">
                 <label for="size_s"> {{$size->size}} {{--({{$size->productCount()}})  --}}</label> 
            </li>
            @endforeach
        </ul>
    </div>
    <div class="widget-product-color widget">
        <h4 class="widget-title">Color</h4>
        <ul class="layer-filter color-filter">
            @foreach($colors as $color)
            <li class="active">
                <input class="color-option checkbox color"  data-url="{{$cat->url}}"  name="color[]" value="{{$color->id}}" style="background: {{$color->color_code}};"
                    type="checkbox">
                <label for=""> {{$color->name}} {{--({{$color->productCount()}}) --}}</label>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="widget-product-collection widget">
        <h4 class="widget-title">Price</h4>
        <ul class="layer-filter collection-filter">
            <li>
                <input name="price[]" class="checkbox price"  value="200_500" type="checkbox">
                <label for="collection_Lauren"> 200-500 (INR) (16) </label>
            </li>
            <li>
                <input name="price[]"  class="checkbox price" value="500_1000" type="checkbox">
                <label for="collection_Lauren"> 500-1000 (INR) (16) </label>
            </li>
            <li>
                <input name="price[]" class="checkbox price"  value="1000_1500" type="checkbox">
                <label for="collection_Lauren"> 1000-1500 (INR) (16) </label>
            </li>
            <li>
                <input name="price[]" class="checkbox price"  value="1500_2000" type="checkbox">
                <label for="collection_Lauren"> 1500-2000 (INR) (16) </label>
            </li>
            <li>
                <input name="price[]" class="checkbox price"  value="2000_2500" type="checkbox">
                <label for="collection_Lauren"> 2000-2500 (INR) (16) </label>
            </li>
            <li>
                <input name="price[]" class="checkbox price"  value="2500_3000" type="checkbox">
                <label for="collection_Lauren"> 2500-3000 (INR) (16) </label>
            </li>
            <li>
                <input name="price[]" class="checkbox price" value="0_3000" type="checkbox">
                <label for="collection_Lauren"> <3000 (INR) (16) </label>
            </li>
        </ul>
    </div>
</div>