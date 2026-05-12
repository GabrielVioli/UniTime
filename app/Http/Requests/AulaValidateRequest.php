<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AulaValidateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()?->is_admin === true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'professor' => ['nullable', 'string', 'max:255'],
            'dia_semana' => ['required', 'string', 'in:segunda,terca,quarta,quinta,sexta,sabado'],
            'horario_inicio' => ['required', 'date_format:H:i'],
            'horario_fim' => ['required', 'date_format:H:i', 'after:horario_inicio'],
            'sala' => ['nullable', 'string', 'max:255'],
            'limite_faltas' => ['required', 'integer', 'min:1'],
            'curso_id' => ['required', 'exists:cursos,id'],
            'turma_id' => [
                'required',
                Rule::exists('turmas', 'id')->where('curso_id', $this->input('curso_id')),
            ],
        ];
    }

    public function validated($key = null, $default = null): mixed
    {
        $data = parent::validated($key, $default);

        if ($key !== null) {
            return $data;
        }

        unset($data['curso_id']);

        foreach (['sala'] as $field) {
            if (blank($data[$field] ?? null)) {
                unset($data[$field]);
            }
        }

        return $data;
    }
}
