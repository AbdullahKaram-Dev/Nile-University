<?php

namespace App\Http\Requests\Web\Admin;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\Web\Admin\ValidationResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChangeStartupDealStatus extends FormRequest
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
            'deal_current_status' => ['required',Rule::in([0,1])]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validationToJson($validator->errors()));
    }
}
