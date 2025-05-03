<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    protected function redirectTo()
    {
        if (auth()->user() && auth()->user()->hasRole('admin')) {

            return route('admin.kpi.dashboard');
        }
        return route('myBroadcasts');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(\Illuminate\Http\Request $request, $user) // Adiciona tipo para $request
    {
        if ($user->status == 'blocked') {
            auth()->logout();
            return redirect()->route('account.blocked');
        }

        // Verifica se há um parâmetro 'redirect_to' na requisição
        if ($request->has('redirect_to')) {
            $redirectTo = $request->input('redirect_to');
            // Validação básica para garantir que é uma URL
            if (filter_var($redirectTo, FILTER_VALIDATE_URL)) {
                // Lista de domínios permitidos para redirecionamento
                $dominiosPermitidos = [
                    'https://app.liveturb.com', 
                    'https://liveturb.com',
                    config('cors.allowed_origins')[0] ?? 'http://localhost:3000'
                ];
                
                // Verifica se o URL de redirecionamento começa com algum dos domínios permitidos
                foreach ($dominiosPermitidos as $dominio) {
                    if (strpos($redirectTo, $dominio) === 0) {
                        return redirect()->to($redirectTo);
                    }
                }
            }
        }

        // Se não houver 'redirect_to' válido, usa a lógica padrão 'intended'
        return redirect()->intended($this->redirectPath());
    }
}
