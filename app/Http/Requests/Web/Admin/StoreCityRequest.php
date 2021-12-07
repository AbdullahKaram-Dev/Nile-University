<?php

namespace App\Http\Requests\Web\Admin;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\Web\Admin\ValidationResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
{
    use ValidationResponse;

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'city_name.en'     => ['required','string','min:3','max:15'],
            'city_name.ar'      => ['required','string','min:3','max:15'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validationToJson($validator->errors()));
    }
}
