<?php

namespace App\Http\Requests;

use App\Trait\Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskRequest extends FormRequest
{

    use Exception;

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
            'title'       => ['required', 'string'],
            'description' => ['required', 'string'],
            'user_id'     => ['required', 'integer']
        ];
    }

    public function messages(): array {
        return [
            'user_id.required' => 'O usuário da tarefa é obrigatório.',
            'user_id.integer'  => 'O id do usuário deve ser um inteiro',

            'title.required' => 'O título da tarefa é obrigatório.',
            'title.string'   => 'O título deve ser uma string.',

            'description.required' => 'A descrição da tarefa é obrigatória.',
            'descrption.string'    => 'A descrição deve ser uma string.'
        ];
    }

    public function failedValidation(Validator $validator): HttpResponseException {
        return $this->retornoExceptionErroRequest(false, 'Erro na validação da criação de uma tarefa', 400, $validator->errors());
    }
}
