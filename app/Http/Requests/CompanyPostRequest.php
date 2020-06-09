<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyPostRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address' => 'required',
            'phone'=> 'regex:/[0-9]{10}/',
            'website'=> 'required|regex:/[a-zA-Z]{3,}[.][a-zA-Z]{3,}/',
            'slogan'=> 'required|min:10',
            'description'=> 'required|min:10',
        ];
    }
}
