<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTempMediaRequest extends FormRequest
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
            'file' => [
               'required','mimes:jpg,jpeg,png,gif, |max:4096',
            ],
            'user_id' => [
              'required',
            ]
        ];
    }

    public function messages()
    {
        return [
          'file.mimes' => 'Only jpg,jpeg,png,gif are allowed.',
          'user_id.required' => 'User id is required'
        ];
             
    }
}
?>