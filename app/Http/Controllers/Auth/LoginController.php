<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use PhpParser\Builder\Property;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Cast\Array_;

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
            'username' => 'required',
            'password' => 'required',
        ]);

        if(auth()->attempt(array(
            'cpf' => $input['username'],
            'password' => $input['password'])) ||
        auth()->attempt(array(
            'email' => $input['email'],
            'password' => $input['password'])))
        {
            if (auth()->user()->type == 'gestor') {
                return redirect()->route('manager.dashboard');
            }else if (auth()->user()->type == 'administrativo') {
                return redirect()->route('dashboard');
            }else{
            return redirect()->route('login')
                ->with('error','Endereço de Email|cpf ou senha estão incorreto!.');
            }
        }

    }

    // public function username()
    // {
    //     # pega os valores do input
    //     $loginValue = request('username');
    //     # verifica se tem email valido ou texto valido
    //     $this->username = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email': 'cpf';
    //     //dd($username);
    //     # faz um merge nos valores
    //     request()->merge([$this->username => $loginValue]);
    //     # retorna o tipo de login
    //     return property_exists($this, 'cpf') ? $this->username : 'email';
    // }
}
