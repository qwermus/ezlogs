<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Prepare phone number without text
        $this->merge([
            'phone_int' => preg_replace('/[^\d]+/', '', $this->phone_text),
            'license' => strtoupper($this->license)
        ]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => ['sometimes', 'nullable', 'string', 'min:2', 'max:10'],
            'surname' => ['sometimes', 'nullable', 'string', 'min:2', 'max:10'],
            'age_from' => ['sometimes', 'nullable', 'numeric', 'min:'.config('api.ageMin'), 'max:'.config('api.ageMax')],
            'age_till' => ['sometimes', 'nullable', 'numeric', 'min:'.config('api.ageMin'), 'max:'.config('api.ageMax')],
            'license' => ['sometimes', 'nullable', 'string', 'min:2', 'max:8'],
            'photo' => ['sometimes', 'nullable', 'string', 'min:2', 'max:60'],
            'phone_text' => ['sometimes', 'nullable', 'string', 'min:2', 'max:15'],
            'address' => ['sometimes', 'nullable', 'string', 'min:2', 'max:1000'],
            "comment.*"  => ['sometimes', 'nullable', 'string', 'min:2', 'max:10000'],
        ];
    }
}
