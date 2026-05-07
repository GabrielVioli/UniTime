<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidateRequest;
use App\Http\Requests\RegisterValidateRequest;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        $turmas = Turma::all();

        return view('auth.register', compact('turmas'));
    }

    public function register(RegisterValidateRequest $request)
    {
        $data = $request->validated();

        $user = User::create($data);

        Auth::login($user);

        return redirect()->route('authenticated.dashboard');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginValidateRequest $request)
    {
        $credentials = $request->validated();

        if (! Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'E-mail ou senha inválidos.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('authenticated.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
