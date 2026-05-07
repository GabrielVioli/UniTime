<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminValidateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'admin_code' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'O e-mail e obrigatorio.',
            'email.email' => 'Informe um e-mail valido.',
            'password.required' => 'A senha e obrigatoria.',
            'admin_code.required' => 'O codigo de administrador e obrigatorio.',
        ];
    }
}
