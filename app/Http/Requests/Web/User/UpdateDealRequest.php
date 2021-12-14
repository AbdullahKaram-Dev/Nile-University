<?php

namespace App\Http\Requests\Web\User;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\Web\Admin\ValidationResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDealRequest extends FormRequest
{
    use ValidationResponse;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'deal_id'            => ['required',Rule::exists('deals','id')],
            'deal_name.en'       => ['required','string','min:3','max:15'],
            'deal_name.ar'       => ['required','string','min:3','max:15'],
            'deal_description.en' => ['required','string','min:3','max:500'],
            'deal_description.ar' => ['required','string','min:3','max:500'],
            'deal_value' => ['required','string','min:3','max:15'],
            'deal_logo' => ['nullable','image','mimes:jpg,png,jpeg,gif,svg','max:2000']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validationToJson($validator->errors()));
    }
}
