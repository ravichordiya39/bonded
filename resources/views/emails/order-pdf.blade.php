<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Template</title>
</head>

<body>
  <div class="wrapper"
    style="border: 10px solid #216159;  box-sizing: border-box;  float: left;  margin: auto;   width: 100%; box-sizing: border-box;">
    <div class="header"
      style=" border-bottom: 2px solid #eee;  display: table;  padding: 15px;  width: 100%; box-sizing: border-box;">
      <div class="logo" style="  float: left;"> <a style="text-decoration: none;;" href="#"> <img style=" max-width: 120px; height: auto;" src="{{url('public/front')}}/images/logo.png" style=" max-height: 115px;">
        </a> </div>
      <div class="contact" style="float: right;"> <a style="text-decoration: none;;" href="mailto:info@gmail.com"
          style="color:#216159;">info@gmail.com</a>
        <p style=" margin-top: 0;" style="margin-top: 10px;"><a style="text-decoration: none;;" href="tel:+9874563210" style="color:#216159;">+9874563210</a></p>
      </div>
    </div>
    <div class="mid-content"
      style=" border-bottom: 2px solid #eee;  display: table;  padding: 0 15px 25px;  width: 100%; box-sizing: border-box;">
      <h1 style="color: #2a2a2a;  font-size: 24px;  text-align: center;  text-transform: uppercase;">Product Order
        Detail</h1>
      <div class="product-info">
        <h3
          style=" background-color: #216159;  color: #fff;  margin: 25px 0 0;  padding: 7px 10px;  text-transform: uppercase;">
          Product Info</h3>
        <table
          style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%; margin: 0 0 25px; ">
          <thead>
            <tr>
              <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"colspan="6" align="left">Order Details</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"><strong>Order ID: </strong>{{$single->order_id}}<br>
                <strong>Order Date: </strong>@php echo date('d-m-Y', strtotime($single->created_at)); @endphp <br>
                <strong>order InvoiceNO: </strong>INV06012017081111
              </td>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"><strong>Payment Method: </strong>cash<br>
                <strong>Shipping Date: </strong>@php echo date('d-m-Y', strtotime($single->created_at)); @endphp
              </td>
            </tr>
          </tbody>
        </table>
        <table
          style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%; margin: 0 0 25px; ">
          <thead>
            <tr>
              <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"align="left"> Shipping Address: </th>
            </tr>
          </thead>
          <tbody>
            <tr align="left">
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">{{$saddress->name}}<br>
                Email: {{$saddress->email}} Phone: {{$saddress->phone}}<br>
                
                {{$saddress->address1}} {{$saddress->city}} , {{$saddress->state}}<br>
                {{$saddress->country}} Zipcode: {{$saddress->pincode}}<br>
              </td>
            </tr>
          </tbody>
        </table>
<table style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%; margin: 0 0 25px; ">
        <thead>
          <tr>
            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"scope="col">Image</th>
            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"scope="col">Description</th>
            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"scope="col">Quantity</th>
            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"scope="col">Price</th>
          </tr>
        </thead>
        <tbody>
            
        @if ($lists)
        @php
            $cType = checkCurrencySession();
            $column =$cType['column_name'];
            $sell_column =$cType['sell_column'];
        @endphp
            @foreach ($lists as $list)
                @php
                     if(isset($list->pDetail->$sell_column) && $list->pDetail->$sell_column){
                    $maxp=$list->pDetail->$column??0;
                    $sellp=$list->pDetail->$sell_column??0;
                    }else{
                        $sellp=$list->pDetail->$column??0;
                    }
                    $product = $list->product;
                @endphp
                <tr>
                    <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" style="height:60px;width:60px"><img style="width: 75px; max-width: 100%; height: auto;" src="{{$product->image_url}}"> </td>
                    <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">
                      <p style=" margin-top: 0;">{{$product->name}} </p>
                      <p style=" margin-top: 0;">Size : {{$product->pDetail->sizeDetails->size}}</p>
                      <p style=" margin-top: 0;">Color : {{$product->pDetail->colorDetail->name}}</p>
                    </td>
                    <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">{{$list->quantity}}</td>
                    <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"> {{$cType['icon']}} {{$sellp}}</td>
                  </tr>
            @endforeach
        @endif
       
            
        </tbody>
        <tfoot>
            <tr>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" colspan="3" style="text-align:right;"><strong>Sub-Total</strong></td>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" class="text-right"><span class="price-new"> ₹   {{$single->price}}</span> </td>
            </tr>
            <tr>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" colspan="3" style="text-align:right;"><strong>Flat Shipping Rate</strong></td>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" class="text-right"><span class="price-new"> ₹  {{$single->shipping}}</span> </td>
            </tr>
            <tr>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" colspan="3" style="text-align:right;"><strong>Tax Amount</strong></td>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" class="text-right"><span class="price-new">  ₹ {{$single->tax}}</span> </td>
            </tr>
            <tr>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" colspan="3" style="text-align:right;"><strong>Total Net Payable Amount</strong></td>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" class="text-right"><span class="price-new">  ₹ {{$single->total_price}}</span> </td>
            </tr>
          </tfoot>
    </table>

    <table style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%;">
        <thead>
          <tr>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Order Date</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Order Delivery Status</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">About Order</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">@php echo date('d-m-Y', strtotime($single->created_at)); @endphp</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">{{ucfirst($single->order_status)}}</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"></td>
          </tr>
        </tbody>
      </table>

    </div>
    <div class="customer-info">
      <h3
        style=" background-color: #216159;  color: #fff;  margin: 25px 0 0;  padding: 7px 10px;  text-transform: uppercase;">
        Customer Info</h3>
      <table
        style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%;">
        <tbody>
          <tr>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Name</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">{{$saddress->name}}</td>
          </tr>
          {{-- <tr>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Company name</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">company</td>
          </tr> --}}
          <tr>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Address</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"> {{$saddress->address1}}  {{$saddress->address2}}</td>
          </tr>
          <tr>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">City</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"> {{$saddress->city}}</td>
          </tr>
          <tr>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">State</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"> {{$saddress->state}}</td>
          </tr>
          <tr>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Zip code</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"> {{$saddress->pincode}}</td>
          </tr>
          <tr>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Phone</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"> {{$saddress->phone}}</td>
          </tr>
          {{-- <tr>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Email</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"><a style="text-decoration: none;;" href="mailto:info@gmai.com" target="_blank"> {{$single->shippingAddress->email}}</a></td>
          </tr> --}}
        </tbody>
      </table>
    </div>
  </div>
  <!--container-->
  <div class="footer" style="padding: 15px; box-sizing: border-box;">
    <div>Abeer Jaipur <br>
      6665,ABC Colony.<br>
      Any Country, Any State<br>
      Tel: 770.300.0900<br>
      Fax: 770.300.0094<br>
      <a style="text-decoration: none;;" href="mailto:info@gmail.com" target="_blank">info@gmail.com</a>
    </div>
    <div class="copyright" style="text-align:center; padding-top: 15px;">Copyright 2021 Abeer Jaipur . All Rights
      Reserved </div>
    <!--footer-->
  </div>
  <!--wrapper-->
</div>
<!--wrapper-->
</body>
</html>
    
