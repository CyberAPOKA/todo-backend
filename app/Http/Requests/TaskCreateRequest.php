<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:30',
            'description' => 'required|string|max:500',
            'date' => 'required|date',
            'status' => 'required|in:pending,in_progress,completed',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O campo título é obrigatório.',
            'title.string' => 'O título deve ser um texto válido.',
            'title.max' => 'O título não pode ter mais que 30 caracteres.',

            'description.required' => 'O campo descrição é obrigatório.',
            'description.string' => 'A descrição deve ser um texto válido.',
            'description.max' => 'A descrição não pode ter mais que 500 caracteres.',

            'date.required' => 'O campo data é obrigatório.',
            'date.date' => 'A data deve ser válida.',

            'status.required' => 'O campo status é obrigatório.',
            'status.in' => 'O status deve ser "pending", "in_progress" ou "completed".',
        ];
    }
}
