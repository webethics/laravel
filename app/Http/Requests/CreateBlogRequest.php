<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
{ 
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /*public function authorize()
    {
        return false;
    }*/ 

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'     => [
                'required',
            ],
            'image' => [
			    'required',
                'mimes:jpg,jpeg,png,gif, |max:4096',
                //'dimensions:min_width=1100,min_height=500'
            ],
            'content'     => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
          'image.mimes' => 'Only jpg,jpeg,png,gif are allowed.',
          //'image.dimensions' => 'Image resolution must be atleast 1100*500 dimension.',
        ];
             
    }
}
?>