<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemoveAuctionMediaRequest extends FormRequest
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
        	'image_type'=>[
        		'required',
        	],
            'mediaId' => [
              'required',
            ]
        ];
    }

    public function messages()
    {
        return [
          'mediaId.required' => 'Media Id is required',
          'image_type.required' => 'Something went wrong, please try later!'
        ];
             
    }
}
?>