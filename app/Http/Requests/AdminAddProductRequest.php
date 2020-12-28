<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAddProductRequest extends FormRequest
{
    /**
     * Determine if the users is authorized to make this request.
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
            //
            'image' => 'required',
            'price' => 'required',
            'cost_price' => 'required',
            'vote' => 'required',
            'status' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'image.required' => 'Image is required',
            'price.required' => 'Pride is required',
            'cost_price.required' => 'Cost price is required',
            'vote' => 'Vote is required',
            'status' => 'Status is required'
        ];
    }
}
