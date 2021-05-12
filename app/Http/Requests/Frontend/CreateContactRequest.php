<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'  => [
                'required',
            ],
            'email' =>[
                'required','email',
            ],
            'message' => [
            	'required',
            ],
			'g-recaptcha-response' => ['required','recaptcha']
        ];
    }
	
	
	
}