<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\OrderTemp;
use App\Model\Order;
use App\Model\Address;
use App\Model\Bank;
use App\Model\ProductAttribute;
use App\Model\OrderDetail;
class CheckoutController extends Controller
{    
    public function __construct()
    {
        $this->middleware('auth');        
    }
    
       
    public function address() {
        
        $order = Auth::user()->OrderTemp;
        if(empty($order)){
            return redirect(url("/"));
        }
        if(empty($order->delivery_id)){
            return redirect(url(UrlCheckoutCart()));
        }
        
        $address = Auth::user()->Address;
       
        $province = $this->province;
//        if(empty($address)){
//            $address = new Address();
//        }
        $recommend = $this->get_group_product("recommend");
        //navigator
        $navigator = [
            ['url' => '/','text' => trans('common.home')],
            ['url' => UrlCheckoutCart(),'text' => trans('cart.Shopping Cart') ],
            ['text' => trans('cart.Shipping Address') ],
            
        ];
        
        return view('checkout.address',compact('navigator', 'recommend', 'order', 'address', 'province'));
    }
    
    function form_address($id=null) {
        if(empty($id)){
            $teturn['address'] = new Address(); 
        }else{
            $teturn['address'] = Address::findOrFail($id);        
            if(Auth::user()->id != $teturn['address']->user_id){
                 $teturn['address'] = new Address();
            }
        }
        
        $teturn['province'] = $this->province;
        
        return view('checkout.form_address',$teturn);
    }
    
    public function save_address(Request $request)
    {
//        prx($request->all());
        $this->validate($request, $this->validate_address());

        if(!empty($request['id'])){
            $address = Address::findOrFail($request['id']);
            $address->update($request->all());
            $id = $request['id'];
        } else {
            $Address = $request->user()->Address()->create($request->all());
            $id = $Address->id;
        }
        
        $temp = Auth::user()->OrderTemp;
        if(!empty($temp)){
            $temp->update(['address_id' => $id]);                                        
        } 
        
        return redirect(url(UrlCheckoutVerify()));
    }
    
    function remove_address($id){   
        if(Address::destroy($id)){
            message("success","ลบข้อมูลเรียบร้อยแล้วค่ะ");
        }else{
            message("warning","ไม่สามารถลบข้อมูลได้");
        }        
        return redirect(url(UrlCheckoutAddress()));
    }
    
    function validate_address(){       
        return  [
            'firstname' => ['required'],
            'lastname' => ['required'],
            'address' => ['required'],
            'sub_district' => ['required'],
            'district' => ['required'],
            'province' => ['required'],
            'postcode' => 'required|digits:5|integer',
            'tel' => ['required'],      
        ];
    }
    
    function verify(Request $request) {
                         
        if($request->isMethod('post') && !empty($request->all())){            
            $temp = Auth::user()->OrderTemp;
            if(!empty($temp)){
                $temp->update(['address_id' => $request['address_id']]);   
                return redirect(url(UrlCheckoutVerify()));
            }            
        }
        
        
        $order = Auth::user()->OrderTemp;
//        pr($order->toArray());
        if(empty($order)){
            return redirect(url("/"));
        }
        if(empty($order->address->address)){
            return redirect(url(UrlCheckoutAddress()));
        }        
       
        $recommend = $this->get_group_product("recommend");
        //navigator
        $navigator = [
            ['url' => '/','text' => trans('common.home')],
            ['url' => UrlCheckoutCart(),'text' => trans('cart.Shopping Cart') ],
            ['url' => UrlCheckoutAddress(),'text' => trans('cart.Shipping Address') ],
            ['text' => trans('cart.Review') ],
            
        ];
        
        return view('checkout.verify',compact('navigator', 'recommend', 'order'));
        
    }

        
    function success(Request $request) {
        
        if($request->isMethod('post') && !empty($request->all())){                   
//            prx($request->all());
            $order = Auth::user()->OrderTemp;
            if(empty($order)){                
                return redirect(url("/"));
            }   
//            pr($order->toArray());
//            pr(unserialize($order->data));
            $order_detail = unserialize($order->data);
            if(empty($order)){
                return redirect(url("/"));
            }
            if(empty($order->address->address)){
                return redirect(url(UrlCheckoutAddress()));
            }
            $address = $order->address;
//            pr($address->toArray());
            $temp = cal_price($order);
//            pr($temp);
            
            $temp_sell = Order::where('created_at', 'like', date('Y-m').'%')
                ->select('order_id')->orderBy('id','desc')->first();
//            pr($temp_sell->order_id);
            if(empty($temp_sell->order_id)){
                $order_id = date('ym')."0001";
            }else{
                $order_id = $temp_sell->order_id+1;
            }
            
            $data = array(
                "order_id" => $order_id,
                'user_id' => Auth::user()->id,
                "product_price" => $temp['subtotal'],                
                "delivery_price" => $temp['delivery_price'],
                "payment_price" => $temp['payment_price'],                
                "sum_product_delivery" => $temp['sum_product_delivery'],
                "discount" => $temp['discount'],
                "discount_price" => $temp['discount_price'],
                "final_sum" => $temp['sum'],
                "status" => ($order->payment_id == 2 ? 4 : 0),                    
                "code_discount" => $order->code_discount,
                "delivery_firstname" => $address->firstname,
                "delivery_lastname" => $address->lastname,
                "delivery_address" => $address->address,
                "delivery_sub_district" => $address->sub_district,
                "delivery_district" => $address->district,                    
                "delivery_province" => $address->province,
                "delivery_postcode" => $address->postcode,
                "delivery_tel" => $address->tel,
                "delivery_name" => $temp['delivery_name'],
                "payment_name" => $temp['payment_name'],
                "note" => $order->note,
                'limit_pay_date' =>  date('Y-m-d h:i:s', strtotime("+2 day", strtotime(date("Y-m-d h:i:s")))),

            );
//            pr($data);
            $order = Order::create($data); //save 1

            
                                            
                                            

            foreach ($order_detail as $key => $value) {
                $attr = ProductAttribute::find($value['attr_id']);
                $image_stores = $attr->product->image_stores()->orderBy('product_images.position', "asc")->first();               

                if(empty($attr)){
                    continue;
                }
                $data_detail = [
                    'order_id' => $order->id,
                    'product_id' => $attr->product_id,
                    'product_attribute_id' => $attr->id,
                    'p_name' => $attr->product->p_name,
                    'p_price' => $attr->p_price,
                    'p_quantity' => $value['qty'],
                    'sum' => $attr->p_price * $value['qty'],
                    'option1' => $attr->option1,
                    'option2' => $attr->option2,
                    'image_store_id' => $image_stores->id,
                ];
                OrderDetail::create($data_detail);
            }
            
            
            
            OrderTemp::where('user_id', '=', Auth::user()->id)->delete();  
            $banks = Bank::all(); //all

            $navigator = [
                ['url' => '/','text' => trans('common.home')],
                ['text' => trans('cart.Shopping Cart') ],
                ['text' => trans('cart.Shipping Address') ],
                ['text' => trans('cart.Review') ],
                ['text' => trans('cart.Order Complete') ],

            ];

             return view('checkout.success',compact('navigator', 'banks', 'order'));
                      
        } else {
            return redirect(url("/"));
        }
        
    }
    
    
    
}
