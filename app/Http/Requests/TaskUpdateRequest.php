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
        $taskRules                = parent::rules();
        $taskRules['title']       = ['string'];
        $taskRules['description'] = ['string'];
        $taskRules['user_id']     = ['integer', 'exists:users,id'];
        return $taskRules;
    }

}
