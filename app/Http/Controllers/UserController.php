<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Model\User;
use App\Model\Address;

class UserController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');        
    }
    
    public function user_upload_image(Request $request){        
        
        $user_id = Auth::user()->id;
        $path = base_path() . '/public/uploads/image_user/'.$user_id;
        $path_sub = '/uploads/image_user/'.$user_id;
        if ($request->hasFile('user_image'))
        {
            $photo = $request->file('user_image');           
            $new_name = "profile.".$photo->getClientOriginalExtension();
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if($photo->move( $path, $new_name)){
                echo json_encode(array('path'=> url($path_sub."/".$new_name.'?var='.time())));
                DB::table('users')
                    ->where('id', $user_id)
                    ->update(['user_image' => $path_sub."/".$new_name]);
            }else{                
                echo json_encode(array('path'=> url('/shop/images/demo/user.png')));
            } 
        }else{
            echo json_encode(array('path'=> url('/shop/images/demo/user.png')));
        }
    }
    
    public function profile() {
        $teturn['user'] = User::findOrFail(Auth::user()->id);
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['text' => trans('common.profile') ],
        ];
        return view('user.profile',$teturn);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile_update(Request $request)
    {   
        $id = Auth::user()->id;            
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request['name'],
            'lastname' => $request['lastname'],
            'sex' => $request['sex'],
            'birthday' => $request['birthday'],
            'tel' => $request['tel'],
        ]);
        message("success","แก้ไขข้อมูลเรียบร้อยแล้วค่ะ");
        return redirect(url(customer()));
    }
    
    public function address() {
        
        $teturn['address_data'] = Auth::user()->Address;
        $teturn['address'] = new Address();
        $teturn['province'] = $this->province;
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['text' => trans('user.My Address') ],
        ];
        return view('user.address',$teturn);
    }
    
    
    public function address_create(Request $request)
    {          
        $this->validate($request, $this->validate_address());
        $request->user()->Address()->create($request->all());
        message("success","เพิ่มที่อยู่เรียบร้อยแล้วค่ะ");
        return redirect(url(customer_address()));
    }  
    
    public function address_edit($id)
    {        
//        จะเช็คสิทธิ์การเข้าถึงด้วย แบบใช้ model
//        $teturn['address'] = Auth::user()->Address()->find($id);
        
//        จะเช็คสิทธิ์การเข้าถึงด้วย แบบสร้างเอง
        $teturn['address'] = Address::findOrFail($id);        
        if(Auth::user()->id != $teturn['address']->user_id){
            return redirect(url(customer_address()));
        }
        $teturn['province'] = $this->province;
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['text' => trans('user.My Address') ],
        ];
        return view('user.address_edit',$teturn);
    }
    
    public function address_update(Request $request, $id)
    {
        $address = Address::findOrFail($id);
        $address->update($request->all());
        message("success","แก้ไขข้อมูลเรียบร้อยแล้วค่ะ");
        return redirect(url(customer_address()));
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
    
    function address_remove($id){   
        if(Address::destroy($id)){
            message("success","ลบข้อมูลเรียบร้อยแล้วค่ะ");
        }else{
            message("warning","ไม่สามารถลบข้อมูลได้");
        }        
        return redirect(url(customer_address()));
    }
    
    
   
}
