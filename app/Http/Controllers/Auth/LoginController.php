<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm(Request $request)
    {
        $tries = $request->session()->get('login_tries', 0);

        $frase = __('messages.teste');
        echo "Frase: ".$frase;

        return view('auth.login', [
            'tries' => $tries
        ]);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request){
        $creds = $request->only(['email', 'password']);

        //p/ excluir uma sessão:
        //$request->session()->forget('login_tries');

        if(Auth::attempt($creds)){
            $request->session()->put('login_tries', 0);
            return redirect()->route('home');
        }else{
            $tries = intval($request->session()->get('login_tries', 0));
            $request->session()->put('login_tries', ++$tries);

            return redirect()->route('login')->with('warning', 'E-mail e/ou senha inválidos.');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
