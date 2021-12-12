<?php

namespace App\Http\Requests\Web\Admin;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\Web\Admin\ValidationResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserStartup extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'sector_ids' => ['array','required'],
            'sector_ids.*' => ['exists:sectors,id'],
            'startup_logo' => ['required','image','mimes:jpg,png,jpeg,gif,svg','max:2000'],
            'city_id' => ['required','exists:cities,id'],
            'startup_name' => ['required','string','min:5','max:100','unique:startups,startup_name']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validationToJson($validator->errors()));
    }
}
