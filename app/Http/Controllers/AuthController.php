<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidateRequest;
use App\Http\Requests\RegisterValidateRequest;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        $cursos = Curso::with('turmas')->orderBy('nome')->get();

        return view('auth.register', compact('cursos'));
    }

    public function register(RegisterValidateRequest $request)
    {
        $user = User::create($request->safe()->only([
            'name',
            'email',
            'password',
            'turma_id',
        ]));

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
