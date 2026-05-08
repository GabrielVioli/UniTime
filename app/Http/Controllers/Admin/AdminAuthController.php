<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminValidateRequest;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(AdminValidateRequest $request)
    {
        if ($request->admin_code !== 'UNITIMES-ADMIN') {
            return back()
                ->withErrors(['admin_code' => 'Código de administrador inválido.'])
                ->onlyInput('email');
        }

        if (! Auth::attempt($request->only('email', 'password'))) {
            return back()
                ->withErrors(['email' => 'E-mail ou senha inválidos.'])
                ->onlyInput('email');
        }

        if (! auth()->user()->is_admin) {
            Auth::logout();

            return back()
                ->withErrors(['email' => 'Este usuário não possui acesso de administrador.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }
}
