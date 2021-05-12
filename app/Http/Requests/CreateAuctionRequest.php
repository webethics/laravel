<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAuctionRequest extends FormRequest
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
            'category_id' => [
                'required',
            ],
            'short_description' => [
                'required',
            ],
            'description' => [
                'required',
            ],
            'amount' =>[
                'required','numeric',
            ],
            'min_bid' =>[
                'required','numeric','lt:max_bid',
            ],
            'max_bid' =>[
                'required','numeric','gt:min_bid',
            ],
            'image' => [
                'mimes:jpg,jpeg,png,gif, |max:4096',
            ],
            'temp_images' => [
              'required',
            ]
        ];
    }

    public function messages()
    {
        return [
          'image.mimes' => 'Only jpg,jpeg,png,gif are allowed.',
          'temp_images.required' => 'Atleast 1 images is required.',
          'amount.required' => 'The estimation field is required.',
          'min_bid.required' => 'The min estimation field is required.',
          'max_bid.required' => 'The max estimation field is required.',
          'amount.required' => 'The estimation must be a number.',
          'min_bid.numeric' => 'The min estimation must be a number.',
          'max_bid.numeric' => 'The max estimation must be a number.',
          'min_bid.lt' => 'The min estimation must be less than '.$this->max_bid,
          'max_bid.gt' => 'The max estimation must be greater than '.$this->min_bid
        ];
             
    }
}
