<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    // Permitir que qualquer usuário logado use essa validação
    public function authorize(): bool
    {
        return true; 
    }

    // Regras estritas de validação
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }

    // Mensagens personalizadas em português (opcional, mas ganha pontos com o professor!)
    public function messages(): array
    {
        return [
            'title.required' => 'O título da tarefa é obrigatório.',
            'title.min' => 'O título deve ter pelo menos 3 caracteres.',
        ];
    }
}