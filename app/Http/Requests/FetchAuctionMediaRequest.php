<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FetchAuctionMediaRequest extends FormRequest
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
            'auction_id' => [
              'required',
            ],
            'request' => [
              'required',
            ]
        ];
    }

    public function messages()
    {
        return [
          'auction_id.required' => 'Auction Id is required',
          'request.required' => 'Something went wrong, please try later!!'
        ];
             
    }
}
?>