<?php

namespace App\Http\Requests\Web\Admin;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Traits\Web\Admin\ValidationResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSectorRequest extends FormRequest
{

    use ValidationResponse;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'sector_id'          => ['required',Rule::exists('sectors','id')],
            'sector_name.en'     => ['required','string','min:3','max:15'],
            'sector_name.ar'     => ['required','string','min:3','max:15'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->validationToJson($validator->errors()));
    }
}
