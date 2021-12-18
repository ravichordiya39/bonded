<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{$title}}</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body bgcolor="#fff">

    <!-- Preview Text goes here-->
    <div style="font-size: 1px; color: #efe1b0;display:none">
        Place your preview message here. This will show in most email client as the preview text in the inbox. Also make sure it is long enough to make up all of the space available by your choosen email clients.
    </div>
   <h1>Your Order is {{$orderData->order_status}}</h1>
    <!-- html goes here -->
    <table width="100%" border="0" cellspacing="0" celpadding="0">
        <tr>
            <!--/ Main Rows inside it creating containers-->
            <td>
                <table class="container" width="540" align="center" border="0" cellspacing="0" celpadding="0" style="margin-top:50px">
                    <!--/ Conatiners-->
                    <tr>
                        <td valign="top" class="logo" style="padding: 5px 20px 0px 30px;">
                            <a href="https://abeerjaipur.com">
                                <img style="margin-left: -15px" src="https://abeerjaipur.com/storage/logo/logo.png" alt="Logo Images" width="120px" height="45" border="0"> 
                            </a>
                        </td>
                        <!--Logo Rows-->

                         <td valign="top">
                            <table style="text-align: right; width: 100%;">
                                <tr> <td><b>Abeer Jaipur </b></td></tr>
                                <tr> <td>xxxx xxxx xxxx xxxx ,</td></tr>
                                <tr> <td>xx xxxx xxxx xx,</td></tr>
                                <tr> <td>  Jaipur, Rajasthan 302022</td></tr>
                                <tr> <td>abeerjapur@gmail.com </td></tr>
                                <tr> <td>+911234567890</td></tr>
                            </table>
                        </td>
                        <!--/ ADDRESS-->
                    </tr>
                    <!--/ EMAIL-->
                    
                    <tr>
                        <td valign="top">
                            <table style="width: 100%; margin-top: 30px; margin-bottom: 20px;">
                                <tr><td><strong>Dear, </strong>{{$name}}</td></tr> 
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="container" width="540" align="center" border="0" cellspacing="0" celpadding="0" style="margin-bottom: 20px;">
                                <tr>
                                     <td>Thank You for ordering with Abeer Jaipur. Your Order Id : <strong>{{$orderid}}</strong>,Your Order is <strong>{{$orderData->order_status}}</strong></td>
                                </tr>
                             </table>
                        </td>
                    </tr>
                    <!--/ INVOICE NUMBER-->
                    
                    <tr>
                        <td valign="top" width="50%"><b>Order Details : </b></td>
                    </tr>
                    
                    <tr>
                        <td valign="top" class="ammount" style=" border-bottom: 2px solid #eee;">
                            <table style="width: 100%;">
                                <thead>
                                  <tr>
                                    <th>Product Name</th> 
                                    <th>Product Color</th> 
                                    <th>Product Qty</th> 
                                    <th>Price.</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    {!! $orderDetails !!}
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="ammount" style=" border-bottom: 2px solid #eee; padding: 5px 0px;">
                            <table style="width: 100%; margin-top: 1px;">
                                  <tr> <td><b>Total Amount :</b> {!! $totalAmount !!}</td></tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="ammount" style=" border-bottom: 2px solid #eee; padding: 5px 0px;">
                            <table style="width: 100%; margin-top: 1px;">
                                  <tr> <td><b>Full Address :</b> {!! $fullAddress !!}</td></tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" class="ammount" style=" border-bottom: 2px solid #eee; padding: 5px 0px;">
                            <table style="width: 100%; margin-top: 1px;">
                                  <tr> <td><b>Date :</b> {{date('d M Y')}}</td></tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top" style="border-top: 1px solid #1c8283;padding-top: 13px;background: white;">
                            <table style="background: #fff;" border="0" cellpadding="0" cellspacing="0" width="100%" id="templateFooter">
                                <tr>
                                    <td valign="top" class="footerContent" style="padding-top:0;">
                                        <em>Copyright © 2021 ABEERJAIPUR.COM, All rights reserved.</em>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>