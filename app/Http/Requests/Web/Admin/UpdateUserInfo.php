<?php

namespace App\Http\Requests\Web\Admin;

use App\Http\Traits\Web\Admin\ValidationResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateUserInfo extends FormRequest
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
            'name' => ['required','min:5','max:25',Rule::unique('users','name')->ignore($this->user_id)],
            'email' => ['required','email',Rule::unique('users','email')->ignore($this->user_id)],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validationToJson($validator->errors()));
    }
}
