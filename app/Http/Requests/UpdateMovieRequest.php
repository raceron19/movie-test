<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovieRequest extends FormRequest
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
        return [
            'title' => ['sometimes','string','max:255'],
            'description' => ['sometimes','string','max:255'],
            'image' => ['sometimes','file','mimes:jpeg,bmp,png'],
            'stock' => ['sometimes','numeric'],
            'rent_price' => ['sometimes','numeric','max:999999.99'],
            'sale_price' => ['sometimes','numeric','max:999999.99'],
        ];
    }
}
