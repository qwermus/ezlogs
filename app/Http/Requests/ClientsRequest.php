<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsRequest extends FormRequest
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

        $input = $this->all();

        // Prepare phone number without text
        foreach ($input['phone_text'] as $key => $value) {
            $input['phone_int'][$key] = preg_replace('/[^\d]+/', '', $value);
        }

        // Convert license to uppercase
        foreach ($input['license'] as $key => $value) {
            $input['license'][$key] = strtoupper($value);
        }

        // Replace data
        $this->replace($input);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => ['required', 'numeric', 'min:1', 'max:1000000'],


            'firstname'    => ['required', 'array', 'size:'.intval($this->quantity) ],
            'firstname.*' => ['required', 'string', 'min:2', 'max:10'],

            'surname'    => ['required', 'array', 'size:'.intval($this->quantity) ],
            'surname.*' => ['required', 'string', 'min:2', 'max:10'],

            'age'    => ['required', 'array', 'size:'.intval($this->quantity) ],
            'age.*' => ['required', 'numeric', 'min:'.config('api.ageMin'), 'max:'.config('api.ageMax')],

            'license'    => ['required', 'array', 'size:'.intval($this->quantity) ],
            'license.*' => ['required', 'string', 'regex:'.config('api.licenseMask')],

            // Photo dimensions
            'photo'    => ['required', 'array', 'size:'.intval($this->quantity) ],
            'photo.*' => [
                'required',
                'image',
                'dimensions:'.
                    'min_width='.config('api.photoDimensionsMin').','.
                    'min_height='.config('api.photoDimensionsMin').','.
                    'max_width='.config('api.photoDimensionsMax').','.
                    'max_height='.config('api.photoDimensionsMax')
            ],

            'phone_text'    => ['required', 'array', 'size:'.intval($this->quantity) ],
            'phone_text.*' => ['required', 'string', 'min:5', 'max:15'],

            'phone_int'    => ['required', 'array', 'size:'.intval($this->quantity) ],
            'phone_int.*' => ['required', 'string', 'min:5', 'max:10', 'regex:/^[\d]+$/'],

            'address'    => ['required', 'array', 'size:'.intval($this->quantity) ],
            'address.*' => ['required', 'string', 'min:5', 'max:1000'],

            // Comment is array. All keys more than 56 ignored
            'comment'    => ['required', 'array', 'size:'.intval($this->quantity) ],
            'comment.*'    => ['required', 'array', 'min:1', 'maxKeyIs56'],
            'comment.*.*'  => ['sometimes', 'nullable', 'string', 'max:10000'],
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'comment.*.maxKeyIs56'  => __('api.keyserror'),
        ];
    }
}
