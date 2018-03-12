<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Cookie;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $data['navigator'] = [
            ['url' => '/','text' => trans('common.home')],
            ['text' => trans('common.login')],
        ];
        return view('auth.login',$data);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        /*
            Event Login to Check Cart
         */
        CheckCookieCart();
        /*
        if live stap2 is address to redirect "checkout/address"
         */
        if (Cookie::get('redirect_stap2') !== null){
            Cookie::queue(Cookie::forget('redirect_stap2'));
            return redirect(url(UrlCheckoutAddress()));
        }else{            
            return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
        }       
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if($user->isAdmin()){
            return redirect()->intended('admin/order');
        }
    }
}
