<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Model\OrderTemp;
use App\Model\Delivery;
use Cookie;
class CartController extends Controller
{
    public function add_to_cart(Request $request) {
        $data = [];
        if( !Auth::guest()) {
            $temp = Auth::user()->OrderTemp;
            $arr['user_id'] = Auth::user()->id;
            if(!empty($temp)){
                $data = unserialize($temp->data);
                foreach ($request['data'] as $key => $value) {
                    if(array_key_exists($value['attr_id'], $data)){
                        $data[$value['attr_id']]['qty'] += $value['qty'];
                    }else{
                        $data[$value['attr_id']] = $value;
                    }                    
                }
                
                $arr['data'] = serialize($data);
                $temp->update($arr);
            }else{
                foreach ($request['data'] as $key => $value) {
                    $data[$value['attr_id']] = $value;
                }
                $arr['data'] = serialize($data);
                OrderTemp::create($arr);
            }
        }else{
            if (Cookie::get('cart') !== null){ 
               $data = Cookie::get('cart');
                foreach ($request['data'] as $key => $value) {
                    if(array_key_exists($value['attr_id'], $data)){
                        $data[$value['attr_id']]['qty'] += $value['qty'];
                    }else{
                        $data[$value['attr_id']] = $value;
                    }                    
                }
            }else{
                //new cookie
                foreach ($request['data'] as $key => $value) {
                    $data[$value['attr_id']] = $value;
                }
            }
            //save 1 month
            Cookie::queue('cart', $data, 45000);            
        }
//        pr($data);
        $ajax_data = $data;
        $request_data = $request['data'];
        return view('cart.dropdown-cart',compact('ajax_data','request_data'));
        
    }
    
    public function remove_cart($id) {
        $data = [];
        if( !Auth::guest()) {
            $temp = Auth::user()->OrderTemp;
            if(!empty($temp)){
                $data = unserialize($temp->data);
                if(isset($data[$id])){
                    unset($data[$id]);
                }
                if(empty($data)){
                    $temp->delete();
                }else{
                    $arr['data'] = serialize($data);
                    $temp->update($arr);  
                }                
            }
        }else{
            if (Cookie::get('cart') !== null){ 
               $data = Cookie::get('cart');
               if(isset($data[$id])){
                   unset($data[$id]);
                   Cookie::queue('cart', $data, 45000);
               }               
            }
        }
        $ajax_data = $data;
        
        return view('cart.dropdown-cart',compact('ajax_data')); 
    }
    
       
    public function index() {
        
        $delivery = Delivery::orderBy('id')->pluck('name', 'id')->prepend('--- '.trans('cart.Select Delivery').' ---','');
        $payment = _get_payment();
        $recommend = $this->get_group_product("recommend");
        //navigator
        $navigator = [
            ['url' => '/','text' => trans('common.home')],
            ['text' => trans('cart.Shopping Cart') ],
        ];
        
        return view('cart.index',compact('navigator','recommend', 'delivery', 'payment'));
    }
    
    
    public function action_cart(Request $request) {
//        pr($request->all());
        $return['status'] = "error";
        if( !Auth::guest()) {
            $temp = Auth::user()->OrderTemp;
            if(!empty($temp)){
                $data = unserialize($temp->data);                
                if(array_key_exists($request['attr_id'], $data)){
                    $data[$request['attr_id']]['qty'] = $request['quantity'];
                }
                $arr['data'] = serialize($data);
                $temp->update($arr);
                $return['status'] = "success";
            }            
        } else {
            if (Cookie::get('cart') !== null){ 
                $data = Cookie::get('cart');                   
                if(array_key_exists($request['attr_id'], $data)){
                    $data[$request['attr_id']]['qty'] = $request['quantity'];
                    //save 1 month
                    Cookie::queue('cart', $data, 45000);   
                    $return['status'] = "success";
                }
            }
        }
        
        
        $ajax_data = $data;
        return view('cart.dropdown-cart',compact('ajax_data'));
        
        
    }
    
    
    
    function set_delivery(Request $request) {
        $return['status'] = "error";
        if( !Auth::guest()) {
            $temp = Auth::user()->OrderTemp;
            if(!empty($temp)){
                if(!empty($request['delivery_id'])){
                    $Delivery = Delivery::findOrFail($request['delivery_id']);
                    $arr['delivery_id'] = $request['delivery_id'];
                    $return['price'] = $Delivery->price;
                }else{
                    $return['price'] = 0;
                    $arr['delivery_id'] = NULL;
                }  
                $temp->update($arr);
                $return['status'] = "success";                                                
            }            
            
        } else {               
            $arr = [];
            if (Cookie::get('cart_info') !== null){ 
                $arr = Cookie::get('cart_info');                                            
            }
            if(!empty($request['delivery_id'])){
                $Delivery = Delivery::findOrFail($request['delivery_id']);
                $arr['delivery_id'] = $request['delivery_id'];
                $return['price'] = $Delivery->price;
            }else{
                $return['price'] = 0;
                $arr['delivery_id'] = NULL;
            }  
            Cookie::queue('cart_info', $arr, 45000);
            $return['status'] = "success";
        }
        
        echo json_encode($return);
    }
    
    function set_payment(Request $request) {
        $return['status'] = "error";
        if( !Auth::guest()) {
            $temp = Auth::user()->OrderTemp;
            if(!empty($temp)){
                if(!empty($request['payment_id'])){                    
                    $arr['payment_id'] = $request['payment_id'];                   
                }else{
                    $arr['payment_id'] = NULL;
                }  
                $temp->update($arr);
                $return['status'] = "success";                                                
            }
        } else {
            $arr = [];
            if (Cookie::get('cart_info') !== null){ 
                $arr = Cookie::get('cart_info');                                            
            }
            if(!empty($request['payment_id'])){
                $arr['payment_id'] = $request['payment_id'];
            }else{               
                $arr['payment_id'] = NULL;
            }  
            Cookie::queue('cart_info', $arr, 45000);
            $return['status'] = "success";
        }
        
        echo json_encode($return);
    }
    
    function check_discounts(Request $request) {
        
        check_active_discounts();
        $return['status'] = "error";
        if( !Auth::guest()) {
            $temp = Auth::user()->OrderTemp;            
            if(!empty($temp) && !empty($request['code'])){
                $code_discount = DB::table('code_discounts')->where([
                    ['start', '<=', date("Y-m-d")],
                    ['end', '>=', date("Y-m-d")],['status', '=', 1],
                    ['code', '=', $request['code']]])->first();
                if(!empty($code_discount)){
                    $arr['code_discount'] = $code_discount->code;
                    $return['discount'] = $code_discount->discount;                        
                    $return['status'] = "success";
                }else{
                    $arr['code_discount'] = NULL;
                }
                $temp->update($arr);
            } 
            
        } else {               
//            pr($request['code']);
            if(!empty($request['code'])){
                $code_discount = DB::table('code_discounts')->where([
                    ['start', '<=', date("Y-m-d")],
                    ['end', '>=', date("Y-m-d")],
                    ['status', '=', '1'],
                    ['code', '=', $request['code']]])->first();
                $data = [];
                if (Cookie::get('cart_info') !== null){ 
                    $data = Cookie::get('cart_info');                                            
                }
                if(!empty($code_discount)){
                    $arr['code_discount'] = $code_discount->code;
                    $return['discount'] = $code_discount->discount;                        
                    $return['status'] = "success"; 
                    $data['code_discount'] = $arr['code_discount']; 
                }else{
                    $data['code_discount'] = NULL;
                }
                Cookie::queue('cart_info', $data, 45000);                
            } 
        }
        
        echo json_encode($return);
    }
    
    function write_cookie(Request $request) {
        
        if( !Auth::guest()) {
            $temp = Auth::user()->OrderTemp;
            if(!empty($temp)){
                $data['note'] = $request['note'];
                $temp->update($data);                                          
            }
            return redirect(url(UrlCheckoutAddress()));
        }else{            
            if (Cookie::get('cart_info') !== null){ 
                $data = Cookie::get('cart_info');  
                $data['note'] = $request['note'];
                Cookie::queue('cart_info', $data, 45000);                
            }
            Cookie::queue('redirect_stap2', true, 1500);
            return redirect(url(login()));
        }
        
    }
}
