<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


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
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo(){
        if (Auth()->user()->user_type_id == 7 ) {
            return route('user.dashboard');
        }else{
            return route('admin.dashboard');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
            'cpf' => 'required|max:11',
            'password' => 'required'
        ]);

        if (auth()->attempt(array('cpf'=>$input['cpf'], 'password'=>$input['password']))) {
            if (auth()->user()->user_type_id == 7) {
                return redirect()->route('user.dashboard');
            } else {
                return redirect()->route('admin.dashboard');
            }
            
        }else{
            return redirect()->route('login')->with('error', 'Login ou senha incorretos');
        }
        
    }
}
