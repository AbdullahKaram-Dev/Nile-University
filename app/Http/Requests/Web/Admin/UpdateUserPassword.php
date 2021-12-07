<?php

namespace App\Http\Requests\Web\Admin;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\Web\Admin\ValidationResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UpdateUserPassword extends FormRequest
{
    use ValidationResponse;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => ['required',Rule::exists('users','id')],
            'password' => ['bail','required','confirmed',Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised()],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
         throw new HttpResponseException($this->validationToJson($validator->errors()));
    }
}
