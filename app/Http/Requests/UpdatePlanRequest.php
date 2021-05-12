<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UpdatePlanRequest extends FormRequest
{
   /*  public function authorize()
    {
        return \Gate::allows('user_create');
    }
 */
    public function rules(Request $request)
    {
		//echo '<pre>';print_r($request->plan_id);die;
        return [
			'title'     => [
                'required',
            ],
			 'arabic_title'     => [
                'required',
            ],
			'price'     => [
                'required',
            ],
			'display_order'     => [
                'required'
            ],
			'membership_length'     => [
                'required'
            ]
        ];
    }
	public function messages()
    {
		return [
          /* 'password.regex' => 'Your password must contain 1 lower case character 1 upper case character one number and One special character.', */
		  // 'mobile_number.regex' => 'Your Mobile Number should be minimum 9 digits.',
    //       'mobile_number.min' => 'fhfgs.',
		  'password.regex' => 'Your password must contain 1 lower case character 1 upper case character one number and One special character.',
        ];
			 
    }
	
}
