<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Session;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function checklogin(Request $request){
      

        $request->validate([
            
            'captcha' => 'required|captcha',
            'email' => 'required',
            'password' => 'required'

        ],
        [  'captcha.captcha'=>'Invalid captcha code.',
            'email.required'=>'User Name required',
            'password.required'=>'Password required']);

        $user_data = array(
            'email'  => $request->email,
            'password' => $request->password
        );

        if(Auth::attempt($user_data)){
             
            if (Auth::user()->usertypes_id == 1) {
            return redirect('/admin');
            }
            elseif (Auth::user()->usertypes_id == 2) {
            return redirect('/appadmin');
            }
            elseif (Auth::user()->usertypes_id == 3) {
            return redirect('/siteadmin');
            }
			elseif (Auth::user()->usertypes_id == 4) {
            return redirect('/webadmin');
            }
			elseif (Auth::user()->usertypes_id == 5) {
            return redirect('/editor');
            }
            elseif (Auth::user()->usertypes_id == 6) {
            return redirect('/photoeditor');
            }
            elseif (Auth::user()->usertypes_id == 7) {
            return redirect('/moderator');
            }
            elseif (Auth::user()->usertypes_id == 8) {
            return redirect('/publisher');
            }
            elseif (Auth::user()->usertypes_id == 9) {
            return redirect('/appmanager');
            }
            elseif (Auth::user()->usertypes_id == 10) {
            return redirect('/appclient');
            }
            elseif (Auth::user()->usertypes_id == 12) {
            return redirect('/livestreaming');
            }
            elseif (Auth::user()->usertypes_id == 14) {
            return redirect('/depthead');
            }
            elseif (Auth::user()->usertypes_id == 15) {
            return redirect('/deptasst');
            }
            elseif (Auth::user()->usertypes_id == 16) {
            return redirect('/deptso');
            }

            else {
                return redirect('logout');
            }
        }

         return redirect('/');

       
        
    }

    protected function authenticated(Request $request, $users) {
        
        
        $request->validate([
            
            'captcha' => 'required|captcha',
            'email' => 'required|email',
            'password' => 'password'

        ],
        ['captcha.captcha'=>'Invalid captcha code.']);



        

        if ($users->usertypes_id == 1) {
            return redirect('/admin');
        }
        else {
            return redirect('logout');
         }
    }

    public function logout(Request $request)
    {
         

       
        Session::flush();
        Auth::logout();
        $this->guard()->logout();
        $request->session()->invalidate();
        
        return $this->loggedOut($request) ?: redirect('/');
       
    }
}
