<?php

namespace App\Http\Requests\Web\Admin;

use App\Http\Traits\Web\Admin\ValidationResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateAdminInfo extends FormRequest
{
    use ValidationResponse;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string','min:5','max:255'],
            'email' => ['required', 'string', 'email', 'max:255',
             Rule::unique('admins','email')->ignore(auth()->guard('admin')->user()->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validationToJson($validator->errors()));
    }
}
