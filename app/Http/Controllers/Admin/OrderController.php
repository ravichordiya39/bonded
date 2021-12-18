<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Notification;
use App\Notifications\CancelOrder;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use Razorpay\Api\Api;
use App\Address;
use App\Location;
use App\UserCoupon;
use App\Coupon;
use Auth;
use Session;
use Mail;
use Exception;
use DB;
use Carbon\Carbon;
use App\Mail\OrderCreate;
use App\Http\Controllers\LoginController;
use App\Models\Order;
use App\Models\User;
use App\Models\User\ShippingAddress;

class OrderController extends Controller
{

    public $email;
    public $name;


    public function allOrder($slug=null){

        if(empty($slug)){
            $orders = Order::where('parent_id',0)->latest()->get();
            return view('admin.order.index',compact('orders'));
        }

        if($slug=='shipped'){
    	   $orders = Order::where('parent_id',0)->where('order_status','Shipped')->latest()->get();
        }elseif($slug=='processing'){
            $orders = Order::where('parent_id',0)->where('order_status','Processing')->latest()->get();
        }elseif($slug=='deliverd'){
            $orders = Order::where('parent_id',0)->where('order_status','Deliverd')->latest()->get();
        }elseif($slug=='cancel'){
            $orders = Order::where('parent_id',0)->where('order_status','Cancelled')->latest()->get();
        }elseif($slug=='return'){
            $orders = Order::where('parent_id',0)->where('order_status','Returned')->latest()->get();
        }
    	return view('admin.order.index',compact('orders'));
    }


    public function orderStatus(Request $request){
        $id = $request->id;
        $name = strtolower($request->name);
        $order = Order::find($id);
        
        if($order->order_status=='pending'){
            $order->order_status = 'pending';
            $order->update();
        }else{
            if($name == 'cancelled' || $name == 'returned'){
                if($name == 'cancelled'){
                    $name == 'canceled';
                }
                else{
                    $name == 'return';
                }
                $order->order_status = $name;
                $order->consignment_no = '';
                $order->consignment_link = '';
                $order->expected_date = '';
                $order->update();
            }else{
                $order->order_status = $name;
                $order->update();
            }
        }
           $this->getMailContent($order);
           
           return response()->json(['message'=>ORDER_STATUS,'statusCode'=>200],200);
                
               
            
            

            // $keywords = array(
            //     'CLIENTNAME' => $projectDetailsArray->forename .''.$projectDetailsArray->surname,
            //     'PROJECTID' =>  $projectDetailsArray->project_id,
            //     'PROJECTNAME' => $projectDetailsArray->project_name,
            //     'INVOICEAMOUNT' => $totalDue,
            //     'INVOICEDETAIL' => $mailBody,
            //     );
            //     $subjectKeyword = array(
            //         'PROJECTID'=>$projectDetailsArray->project_id
            //     );

        //    SendEmailByTemplate(4,$email,$keywords,'mail.orderstatus');
        //     return true;
    }

    public function getMailContent($order){
        $lists =  Order::where(['user_id'=>$order->user_id,'id'=>$order->id])->first();
        $saddress=ShippingAddress::find($lists->shipping_address_id);
        $baddress=ShippingAddress::where(['user_id'=>$order->user_id,'status'=>1,'add_type'=>'billing'])->first();
        if(!$baddress){
            $baddress=$saddress;
        }
        $user = User::find($order->user_id);
        $email = $user->email;
        $template='emails.orderstatus';
        $orderDetails = '';
        $cType = checkCurrencySession();
        $column =$cType['column_name'];
        $sell_column =$cType['sell_column'];
        if(!empty($saddress)){
            $fullAddress = '<span>'.$saddress->name.','.$saddress->address1.', '.$saddress->address2.','.$saddress->city.', '.$saddress->state.', '.$saddress->country.','.$saddress->pincode.' </span>';
        }
        $allorder = Order::where('order_id',$order->order_id)->get();
        foreach($allorder as $list){
            $product = $list->product;
            $i= 1;
            if(isset($list->pDetail->$sell_column) && $list->pDetail->$sell_column){
                $maxp=$list->pDetail->$column??0;
                $sellp=$list->pDetail->$sell_column??0;
                }else{
                    $sellp=$list->pDetail->$column??0;
                }
                $orderDetails.='<tr>
                        <td>'.$product->name.'</td>
                        <td>'.$product->pDetail->colorDetail->name.'</td>
                        <td>'.$list->quantity.'</td>
                        <td>₹'.$sellp.'</td>
                    </tr>';
        }
        $data = array('name'=>$user->name, 'orderid'=>$order->order_id, 'totalAmount'=>$order->total_price,'orderDetails'=>$orderDetails, 'fullAddress'=>$fullAddress,'title'=>'Ordered','orderData'=>$order);
        
        $emails = [$user->email];
        $this->name = [$user->name];
        $subject = 'Your orders is'.$order->order_status;
        Mail::send($template, $data, function($message) use($emails,$subject) {
           $message->to($emails, $this->name)->subject($subject);
           $message->from('account@abeerjaipur.com','Abeer Business');
        });

        
    }


    public function orderProcessed(Request $request){
        $id = $request->id;
        $order = Order::find($id);
        if(empty($order->order_completed)){
            if($order->order_processed==1){
                $order->order_processed = 0;
            }else{
                $order->order_processed = 1;
            }

            $order->update();
        }
    }


    public function orderShipping(Request $request){
        $id = $request->id;
        $order = Order::find($id);
        if(empty($order->order_completed)){
            if($order->order_shipped==1){
                $order->order_shipped = 0;
            }else{
                $order->order_shipped = 1;
            }

            $order->update();
        }
    }


    public function orderCompleted(Request $request){
        $id = $request->id;
        $order = Order::find($id);
        if(empty($order->order_completed)){
            $order->order_completed = 1;
        }

        $order->update();
    }
    
    public function returnOrder(Request $request){
        $oid = $request->oid;
        $order = Order::find($oid);
        $order->order_status = 'Returned';
        $order->order__returned_date = date('d-m-Y H:i:s');
        $order->consignment_no = ' ';
        $order->consignment_link = ' ';
        $order->expected_date = ' ';
        $order->update();
        $user = User::find($order->user_id);
        $this->getMailContent($order);
         
           

        return response(array('success'=>true,'message'=>'<span style="color:red">Your Order Returned Successfully.</span>'));
    }

    public function cancelOrder(Request $request){
        $oid = $request->oid;
        $order = Order::find($oid);
        $order->order_status = 'Cancelled';
        $order->order__canelled_date = date('d-m-Y H:i:s');
        $order->consignment_no = ' ';
        $order->consignment_link = ' ';
        $order->expected_date = ' ';
        $order->update();
        $user = User::find($order->user_id);
        $this->getMailContent($order);
             

        return response(array('success'=>true,'message'=>'<span style="color:red">Your Order Cancel Successfully.</span>'));
    }

    public function deliveryDetail(Request $request){
        $oid = $request->oid;
        $data = Order::find($oid);
        $data->consignment_no = $request->consignment_no;
        $data->consignment_link = $request->consignment_link;
        $data->expected_date = $request->expected_delivery_date;
        $data->order_status = 'delivered';
        $data->update();
         return response(array('success'=>true,'message'=>'<span style="color:green">Delivery Detail Added Successfully.</span>'));
    }



    public function reportDetail(){
        $orders = Order::latest()->get();
        return view('admin.report.index',compact('orders'));
    }

    public function exportsData(){
        $from_date = date('y-m-d');
        $to_date = date('y-m-d');
        return Excel::download(new OrdersExport($from_date, $to_date), date('d-m-Y').'-reports.xlsx');
    }


    public function saleReport($slug=null){

        if(empty($slug)){
            $orders = Order::latest()->get();
            return view('admin.order.saleReport',compact('orders'));
        }

        if($slug=='shipped'){
           $orders = Order::where('order_status','Shipped')->latest()->get();
        }elseif($slug=='processing'){
            $orders = Order::where('order_status','Processing')->latest()->get();
        }elseif($slug=='deliverd'){
            $orders = Order::where('order_status','Deliverd')->latest()->get();
        }elseif($slug=='cancel'){
            $orders = Order::where('order_status','Cancelled')->latest()->get();
        }elseif($slug=='return'){
            $orders = Order::where('order_status','Returned')->latest()->get();
        }
        return view('admin.order.saleReport',compact('orders'));
    }


    function fetchSalesData(Request $request)
    {
        if($request->ajax()) {
            if($request->from_date != '' && $request->to_date != '')    {
               $data = DB::table('orders')
                 ->whereBetween('created_at', array($request->from_date, $request->to_date))
                 ->get();
                }
              else
              {
               $data = DB::table('orders')->orderBy('created_at', 'desc')->get();
            }
          echo json_encode($data);
        }
    }


    public function exportsCustomerData(){
        $from_date = date('y-m-d');
        $to_date = date('y-m-d');
        return Excel::download(new OrdersExport($from_date, $to_date), date('d-m-Y').'-reports.xlsx');
    }


    public function customerReport($slug=null){

        if(empty($slug)){
            $users = User::where('user_type','user')->get();
            return view('admin.order.customerReport',compact('users'));
        }
        return view('admin.order.customerReport',compact('users'));
    }


    function fetchCustomerData(Request $request)
    {
        if($request->ajax()) {
            if($request->from_date != '' && $request->to_date != '')    {
               $data = DB::table('users')
                 ->where('user_type','user')
                 ->whereBetween('created_at', array($request->from_date, $request->to_date))
                 ->get();
                }
              else
              {
               $data = DB::table('users')->where('user_type','user')->orderBy('created_at', 'desc')->get();
            }
          echo json_encode($data);
        }
    }


    public function exportsInventoryData(){
        $from_date = date('y-m-d');
        $to_date = date('y-m-d');
        return Excel::download(new OrdersExport($from_date, $to_date), date('d-m-Y').'-reports.xlsx');
    }


    public function inventoryReport($slug=null){

        if(empty($slug)){
            $users = User::where('user_type','user')->get();
            return view('admin.order.customerReport',compact('users'));
        }
        return view('admin.order.customerReport',compact('users'));
    }


    function fetchInventoryData(Request $request)
    {
        if($request->ajax()) {
            if($request->from_date != '' && $request->to_date != '')    {
               $data = DB::table('users')
                 ->where('user_type','user')
                 ->whereBetween('created_at', array($request->from_date, $request->to_date))
                 ->get();
                }
              else
              {
               $data = DB::table('users')->where('user_type','user')->orderBy('created_at', 'desc')->get();
            }
          echo json_encode($data);
        }
    }
    
    public function loadModal(Request $re,$id){
        $data['single']=Order::where(['order_id'=>$id])->first();
        $data['lists']=Order::where(['order_id'=>$id])->get();
        $data['user'] = User::where('id',$data['single']->user_id)->first();
        return view('admin.order.order-detail', $data);
    }
}
