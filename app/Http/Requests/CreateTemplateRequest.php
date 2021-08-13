<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CreateTemplateRequest extends FormRequest
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
         'pdf_image.required' => 'PDF file is required.',
        ];
			 
    }
	
}
