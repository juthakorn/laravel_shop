<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Model\User;
class UpdatePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }
    
    function index(){
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['text' => trans('user.Change Password') ],
        ];
        return view('auth.form_password',$teturn);
    }
    /**
     * Update the password for the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        // Validate the new password length...
        $password = $request->only([
            'current_password', 'new_password', 'new_password_confirmation'
        ]);

        $validator = Validator::make($password, [
            'current_password' => 'required|current_password_match',
            'new_password'     => 'required|min:6|confirmed',
        ]);
         if ( $validator->fails() )
            return back()
                ->withErrors($validator)
                ->withInput();

        $request->user()->fill([
            'password' => Hash::make($request->new_password)
        ])->save();
        message("success","เปลี่ยนรหัสผ่านเรียบร้อยแล้วค่ะ");
        return redirect(url(change_password()));
    }
}