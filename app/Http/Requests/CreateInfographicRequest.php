<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CreateInfographicRequest extends FormRequest
{
   /*  public function authorize()
    {
        return \Gate::allows('user_create');
    }
 */
    public function rules(Request $request)
    {
		
     $validation = array();
		if($request->langauge == '' || $request->langauge == 1 || $request->langauge == 2 ){
			$validation =  [
				'title'     => [
					'required',
				],
				'pdf_image'     => [
					'required',
				]
			];
		}
		if($request->langauge == 2 || $request->langauge == 3 ){
			$validation =  [
				  'arabic_title'     => [
					'required',
				],
				'arabic_pdf_image'     => [
					'required',
				]
				
			];
		}
		
		return $validation;
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
