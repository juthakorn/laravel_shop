<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sunra\PhpSimple\HtmlDomParser;
use App\Model\Order;
use App\Model\Bank;
use App\Model\OrderDetail;
use App\Model\Payment;
use App\Model\PaymentOrder;
use DB;

class OrderController extends Controller
{    
    public function __construct()
    {
           
    }
        
    public function index() {            
        $order = Order::where('user_id' , '=', Auth::user()->id)
                ->orderBy('id', 'desc')
                ->paginate(15);
        
        //navigator        
        $navigator = [
            ['url' => '/','text' => trans('common.home')],
            ['text' => trans('common.my_order') ],
        ];
        return view('order.index',compact('navigator', 'order'));
    }
    
    function detail($id){
        
        $order = Order::where([['order_id' , '=', $id],['user_id', '=', Auth::user()->id]])
                ->first();
        //ตรวจสอบสิทธิ์
        $this->authorize('pagedetail', $order);
        if(!empty($order)){
            $order_detail = $order->order_detail;
            $payment = $order->payment;
            //navigator
            $navigator = [
                ['url' => '/', 'text' => trans('common.home')],
                ['url' => customer_order(), 'text' => trans('common.my_order') ],
                ['text' => trans('common.my_order')." #".$id ],
            ];
            
            return view('order.detail',compact('navigator', 'order', 'order_detail', 'payment'));
        }else{
            return redirect(url(customer_order()));
        }
    }
    
    public function track($track) {
//        pr($track);
        $url = "https://th.kerryexpress.com/th/track/?track=".$track;
        $getContent = get_content($url);

        $fetchHtml = HtmlDomParser::str_get_html($getContent);        
        $content = array();
        foreach ($fetchHtml->find('div[class="col colStatus"]') as $div_role_main) { //pr($div_role_main->plaintext);
            foreach ($div_role_main->find('div[class="status"]') as $key_status => $value_status) {  
                foreach ($value_status->find('div[class="date"]') as $key_date => $value_date) { 
                    $content[$key_status]['date'] = trim($value_date->find('div', 0)->plaintext);
                    $content[$key_status]['time'] = trim($value_date->find('div', 1)->plaintext);
                }
                foreach ($value_status->find('div[class="desc"]') as $key_desc => $value_desc) { 
                    $content[$key_status]['status'] = trim($value_desc->find('div', 0)->innertext);
                    $content[$key_status]['where'] = preg_replace('/\s+/', ' ',trim($value_desc->find('div', 1)->plaintext));
                }
            }
        }
//        pr($content);
        return view('order.track',compact('content'));
    }
    
    public function cancel_order(Request $request)
    {
          
//        prx($request->all());        
        if(!empty($request['id'])){
            $order = Order::findOrFail($request['id']);
            $order->update(['status' => 2, 'cancel_detail' => $request['cancel_detail']]);
            message("success","ยกเลิกรายการสั่งซื้อ #".$order->order_id." เรียบร้อยแล้วค่ะ");
            return redirect(url(customer_order_detail($order->order_id)));
        }else{
            return redirect(url("/"));
        }        
    }
    
    function print_pdf($id){        
        $order = Order::where('order_id' , '=', $id)
                ->first();
        $order_detail = $order->order_detail;
        return view('order.print_pdf',compact('order', 'order_detail'));
    }
    
    function validate_payment(){       
        return  [
            'bank_id' => ['required'],
            'transfer_date' => ['required'],
            'transfer_hour' => ['required'],
            'transfer_minute' => ['required'],
            'transfer_pay' => ['required'],
            'order_id' => ['required']   
        ];
    }
    
    function payment(Request $request) {
        
        
        if ($request->isMethod('post')) {
            $this->validate($request, $this->validate_payment());
            
//            prx($request->all());  
           
            $bank = Bank::findOrFail($request['bank_id'])->toArray();
            $request['transfer_date'] = dateyyyymmdd($request['transfer_date']);
            $request['transfer_time'] = $request['transfer_hour'].":".$request['transfer_minute'];
            $request['bank_info'] = serialize($bank);  
            $request['transfer_pay'] = str_replace(",", "", $request['transfer_pay']);
            $request['user_id'] = Auth::user()->id;
                        
            //upload 
            if ($request->hasFile('transfer_upload'))
            {
                $photo       = $request->file('transfer_upload');                  
                $new_name = time().".".$photo->getClientOriginalExtension();
                $destination = base_path() . '/public/uploads/image_payment';
                $photo->move($destination, $new_name);                
                $request['transfer_file'] = $new_name;
            }
            
            $Payment = Payment::create($request->all());
            $payment_id = $Payment->id;
            $PaymentOrder = [];
            
            foreach ($request['order_id'] as $key => $value) {
                $PaymentOrder[] =  new PaymentOrder([
                    'payment_id' => $payment_id,
                    'order_id' => $value,
                ]);
            }
            DB::table('orders')->whereIn('id', $request['order_id'])->update(array('status' => 3));
            $Payment->payment_order()->saveMany($PaymentOrder);
            
//            exit;
            message("success","แจ้งชำระเงินเรียบร้อยแล้ว  กรุณารอยีนยันการชำระเงินค่ะ");
            return redirect(url(UrlPayment()));
        } 
        
        $hour = [];
        $hour[""] = "--- ".trans('common.Hour')." ---";
        for($i = 0; $i < 24; $i++){
            $hour[substr("0".$i, strlen("0".$i)-2)] = substr("0".$i, strlen("0".$i)-2);
        }
        $minute = [];
        $minute[""] = "--- ".trans('common.Minute')." ---";
        for($i = 0; $i < 60; $i++){
            $minute[substr("0".$i, strlen("0".$i)-2)] = substr("0".$i, strlen("0".$i)-2);
        }
        
        //navigator
        $navigator = [
            ['url' => '/', 'text' => trans('common.home')],
            ['text' => trans('cart.Payment')],
        ];
        $banks = Bank::all();
        
        $order = [];
        if(!Auth::guest()){
            $order = Order::where('user_id', Auth::user()->id)->whereIn('status', [0,3])
                ->orderBy('id', 'desc')->get();
        }
        
        
        
        return view('order.payment',compact('navigator', 'order', 'banks', 'hour', 'minute'));
    }
    
    function payment_info($id){
        $payment = Payment::where('id' , '=', $id)->first();
        if(!empty($payment)){
            $order = $payment->order;
            //navigator
            $navigator = [
                ['url' => '/', 'text' => trans('common.home')],
                ['url' => customer_order(), 'text' => trans('common.my_order') ],
                ['text' => trans('common.Payment Information')." #".$id ],
            ];
            
            return view('order.payment_info',compact('navigator', 'order', 'payment'));
        }else{
            return redirect(url(customer_order()));
        }
    }
    
    
}
