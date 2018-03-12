<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Order;
use App\Model\Bank;
use App\Model\OrderDetail;
use App\Model\Payment;
use App\Model\PaymentOrder;
use DB;
class OrderAdminController extends Controller
{    
    public function __construct()
    {
        $this->middleware("auth");
    }
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {            
//        $order = Order::where()
//                ->orderBy('id', 'desc')
//                ->paginate(20);
        
//        pr($request->all()); 
//        \DB::enableQueryLog();
        $form_search = $request->all();
        $option = [
                    'all' => '------ เลือกทั้งหมด ------',
                    '1' => 'เลขที่สั่งซื้อ',
                    '2' => 'ชื่อ-นามสกุล',
                    '3' => 'ที่อยู่',
                    '4' => 'เบอร์โทร'];
        $order = Order::where(function($query) use ($request) {
                    $keywords = "%%";
                    if ($keyword = ($request->get('keyword'))) {
                        $keywords = '%' . $keyword . '%';
                    }
                    
                    if ($key_search = ($request->get('key_search'))) {
                        switch ($key_search) {
                            case "all":
                                $query->orWhere("delivery_firstname", 'LIKE', $keywords);
                                $query->orWhere("delivery_lastname", 'LIKE', $keywords);
                                $query->orWhere("delivery_address", 'LIKE', $keywords);
                                $query->orWhere("delivery_sub_district", 'LIKE', $keywords);
                                $query->orWhere("delivery_district", 'LIKE', $keywords);
                                $query->orWhere("delivery_province", 'LIKE', $keywords);
                                $query->orWhere("delivery_postcode", 'LIKE', $keywords);
                                $query->orWhere("delivery_tel", 'LIKE', $keywords);
                                $query->orWhere("order_id", 'LIKE', $keywords);
                                break;
                            case "1":
                                $query->orWhere("order_id", 'LIKE', $keywords);
                                break;
                            case "2":
                                $query->orWhere("delivery_firstname", 'LIKE', $keywords);
                                $query->orWhere("delivery_lastname", 'LIKE', $keywords);
                                break;
                            case "3":
                                $query->orWhere("delivery_address", 'LIKE', $keywords);
                                $query->orWhere("delivery_sub_district", 'LIKE', $keywords);
                                $query->orWhere("delivery_district", 'LIKE', $keywords);
                                $query->orWhere("delivery_province", 'LIKE', $keywords);
                                $query->orWhere("delivery_postcode", 'LIKE', $keywords);
                                break;
                            case "4":
                                $query->where("delivery_tel", 'LIKE', $keywords);
                                break;
                            default:
                                break;
                        } 
                    }
                })
                ->where(function($query) use ($request) { 
                    if(isset($_GET['status_order']) && $_GET['status_order'] != "all" ){
                        $query->where('status', $_GET['status_order']);
                    }
                })
                ->where(function($query) use ($request) {
                    if ($start = $request->get('start')) {
                        $query->where('created_at', '>=', $start);                        
                    }
                    if ($end = $request->get('end')) {
                        $query->where('created_at', '<=', $end);                        
                    }
                })
                ->orderBy('id', 'desc')
                ->paginate(20);
//        pr(\DB::getQueryLog());
        
        return view('order_admin.index',compact('order', 'form_search', 'option'));
    }
    
    function detail($id){
        $order = Order::where('order_id' , '=', $id)
                ->first();
        if(!empty($order)){
            $order_detail = $order->order_detail;
            $payment = $order->payment;
            
            
            return view('order_admin.detail',compact('order', 'order_detail', 'payment'));
        }else{
            return redirect(url(UrlAdminOrder()));
        }
    }
    
    function payment_info($id){
        $payment = Payment::where('id' , '=', $id)->first();
        if(!empty($payment)){
            $order = $payment->order;           
            
            return view('order_admin.payment_info',compact('order', 'payment'));
        }else{
            return redirect(url(UrlAdminOrder()));
        }
    }
    
    function payment_action(Request $request) {
        
//        prx($request->all());
        $payment = Payment::where('id' , '=', $request->payment_id)->first();
        if(!empty($payment)){            
            $payment->update(['status' => $request->action]);
            $order = $payment->order;  
            
            if($request->action == "1"){
                foreach ($order as $key => $value) {
                    DB::table('orders')->where('id', $value->id)->update(['status' => 4]);
                }
            }else if($request->action == "2"){
                foreach ($order as $key => $value) {
                    $temp_order = Order::where('id' , $value->id)->where('status' , 3)->first();
                    if(!empty($temp_order)){
                        $chk = $temp_order->check_has_payment;
                        pr($chk->toArray());
                        if(!empty($chk[0])){
                            echo 'has';                        
                        }else{
                            echo 'empty';
                            DB::table('orders')->where('id', $value->id)->update(['status' => 0]);
                        }
                    }
                }
//                 exit;
            }
            
           
            return redirect(url(UrlAdminPaymentinfo($request->payment_id)));
        }else{
            return redirect(url(UrlAdminOrder()));
        }
    }
    
    public function cancel_order(Request $request)
    {
          
//        prx($request->all());        
        if(!empty($request['id'])){
            $order = Order::findOrFail($request['id']);
            $order->update(['status' => 5, 'cancel_detail' => $request['cancel_detail']]);
            message("success","ยกเลิกรายการสั่งซื้อ #".$order->order_id." เรียบร้อยแล้วค่ะ");
            return redirect(url(admin_order_detail($order->order_id)));
        }else{
            return redirect(url("/"));
        }        
    }
    
    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        OrderDetail::where('order_id', $id)->delete();  
        $payorder = PaymentOrder::where('order_id' ,$id)->get();
//        pr($payorder->toArray());
        if(!$payorder->isEmpty()){
            foreach ($payorder as $key => $value) {
                $payment = PaymentOrder::where('payment_id' ,$value->payment_id)->count();    
                if($payment == 1){                    
                    Payment::find($value->payment_id)->delete();
                }else{
                    
                }
                PaymentOrder::find($value->id)->delete();
            }
        }

        message("success","ลบข้อมูลใบสั่งซื้อเรียบร้อยแล้วค่ะ");
        return redirect(url(UrlAdminOrder()));
    }
    
    public function delivery($id, Request $request){
//        pr($id);
//        prx($request->all());   
       
        $order = Order::findOrFail($id);
        if(empty($order->delivery_number)){
            $order->update(['status' => 9, 'delivery_number' => $request->input('delivery_number')]);
            message("success","ใส่เลขพัสดุของเลขที่สั่งซื้อ #".$order->order_id." เรียบร้อยแล้วค่ะ");
        }else{
            $order->update(['delivery_number' => $request->input('delivery_number')]);
            message("success","แก้ไขเลขพัสดุของเลขที่สั่งซื้อ #".$order->order_id." เรียบร้อยแล้วค่ะ");
        }
        
        
        if(!empty($request->input('url_return'))){
            return redirect($request->input('url_return'));
        }else{
             return redirect(url(UrlAdminOrder()));
        }
        
       
    }
}
