<?php
namespace App\Http\Requests\Frontend;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class LoginRequest extends FormRequest
{
   /*  public function authorize()
    {
        return \Gate::allows('user_create');
    }
 */
    public function rules()
    {
        return [
            
			'email*' => [
				'required','email'
			],
			
			'password' => ['required'],
			'g-recaptcha-response' => ['required','recaptcha']
			
        ];
    }
	public function messages()
    {
		return [
          /* 'password.regex' => 'Your password must contain 1 lower case character 1 upper case character one number and One special character.', */
		  'mobile_number.regex' => 'Your Mobile Number should be minimum 9 digits.',
          'mobile_number.min' => 'fhfgs.',
		  'login_password.regex' => 'Your password must contain 1 lower case character 1 upper case character one number and One special character.',
        ];
			 
    }
	
}
