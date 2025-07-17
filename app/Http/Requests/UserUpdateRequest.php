<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends UserRequest
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
        $userRules             = parent::rules();
        $userRules['name']     = ['string', 'min:5', 'max:15'];
        $userRules['email']    = ['email', 'unique:users,email,except,id'];
        unset($userRules['password']);
        return $userRules;
    }
}
