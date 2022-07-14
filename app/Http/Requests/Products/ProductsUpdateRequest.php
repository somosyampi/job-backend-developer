<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ProductsUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'        => ['string', 'unique:products,name', 'max:255'],
            'price'       => ['numeric', 'min:0'],
            'description' => ['string'],
            'category'    => ['string'],
            'image_url'   => ['sometimes', 'image', 'mimes:jpeg,jpg,png']
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Este nome já está sendo utilizado'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error'   => true,
            'message' => $validator->errors()->first()
        ], Response::HTTP_BAD_REQUEST));
    }
}
