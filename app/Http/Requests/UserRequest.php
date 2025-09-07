<?php

namespace App\Http\Requests;

use App\Trait\Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'name'     => ['required', 'string', 'min:5', 'max:15'],
            'email'    => ['required', 'email', 'unique:users,email,except,id'],
            'password' => ['required', Password::min(6)->numbers()->letters()->symbols()]
        ];
    }
    
    public function messages(): array {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.string'   => 'O nome deve ser uma string.',
            'name.min'      => 'O nome deve conter no mínimo 5 caracteres.',
            'name.max'      => 'O nome deve conter no máximo 15 caracteres',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email'    => 'O e-mail não é válido.',
            'email.unique'   => 'O e-mail informado já foi cadastrado.',

            'password.required' => 'A senha é obrigatória.',
            'password.min'      => 'A senha deve conter no mínimo 6 caracteres.',
            'password.numbers'  => 'A senha deve conter números.',
            'password.letters'  => 'A senha deve conter letras.',
            'password.symbols'  => 'A senha deve conter símbolos.',
        ];
    }

    public function failedValidation(Validator $validator): HttpResponseException {
        return $this->retornoExceptionErroRequest(false, 'Erro na validação da criação de um usuário', 400, $validator->errors());
    }
}
