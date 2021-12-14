<?php

namespace App\Http\Requests\Web\User;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\Web\Admin\ValidationResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStartupRequest extends FormRequest
{

    use ValidationResponse;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'startup_id' => ['required','exists:startups,id'],
            'sector_ids' => ['array','required'],
            'sector_ids.*' => ['exists:sectors,id'],
            'startup_logo' => ['nullable','image','mimes:jpg,png,jpeg,gif,svg','max:2000'],
            'city_id' => ['required','exists:cities,id'],
            'startup_name' => ['required','string','min:5','max:100',
                Rule::unique('startups','startup_name')->ignore($this->startup_id)]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validationToJson($validator->errors()));
    }
}
