<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormResquest extends FormRequest
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
        'name' => 'required|min:1|max:100',
        'description' => 'required|min:1|max:500',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'price' => 'required|numeric',
        'category' =>  'required|min:1|max:100'
        ];
    }
}
