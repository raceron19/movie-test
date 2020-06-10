<?php

namespace App\Http\Requests;

use App\Http\Requests\UpdateMovieRequest;
use phpDocumentor\Reflection\Types\Parent_;

class CreateMovieRequest extends UpdateMovieRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules['title'][] = ['required'];
        $rules['description'][] = ['required'];
        $rules['image'][] = ['required'];
        $rules['stock'][] = ['required'];
        $rules['rent_price'][] = ['required'];
        $rules['sale_price'][] = ['required'];
        return $rules;
    }
}
