<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Contact;
use App\Model\AddressShop;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailContact;

class ContactController extends Controller
{
   
    public function __construct()
    {       
    }
    
    public function index(Request $request) {
        $teturn['contact'] = [];
        if(!Auth::guest()){
            $user = Auth::user();
            $teturn['contact']['name'] = $user->name." ".$user->lastname;     
            $teturn['contact']['email'] = $user->email;           
        }
        $teturn['address'] = AddressShop::find(1);
        
        //navigator
        $teturn['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['text' => trans('common.Contact Us') ],
        ];
        
        return view('contact.index',$teturn);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function action(Request $request)
    {   
        $this->validate($request, $this->validate_input());
        if(!Auth::guest()){ //if login
            $contact = $request->user()->Contact()->create($request->all());
        }else{
            $contact = Contact::create($request->all());
        }
        
        $contact_id = $contact->id;
       
        //send mail
        $data = Contact::findOrFail($contact_id);
        // Ship order...
        Mail::to(config('mail.mail_contact'))->send(new MailContact($data));
        
        
        
        message("success","ส่งข้อมูลเรียบร้อยแล้วค่ะ");
        return redirect(url(UrlContactUs()));
    }
    
    function validate_input(){
        return  [
            'name' => ['required'],
            'email' => ['required'],
            'subject' => ['required'],
            'message' => ['required'],
            'result_captcha' => 'required|captcha'
        ];
    }
    
    
    
    
    
    
   
}
