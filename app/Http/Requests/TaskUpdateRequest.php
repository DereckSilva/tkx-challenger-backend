<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TaskUpdateRequest extends TaskRequest
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
        $taskRules       = parent::rules();
        $taskUpdateRules = [
            'id' => ['required', 'integer']
        ];
        return array_merge($taskRules, $taskUpdateRules);
    }

    public function messages(): array {

        $taskMessages = parent::messages();
        $taskUpdateMessages = [
            'id.required' => 'O id da tarefa é obrigatório',
            'id.integer'  => 'O id da tarefa deve ser um número.'
        ];
        return array_merge($taskMessages, $taskUpdateMessages);
    }

    public function failedValidation(Validator $validator): HttpResponseException {
        return $this->retornoExceptionErroRequest(false, 'Erro na validação de uma tarefa', 400, $validator->errors());
    }
}
