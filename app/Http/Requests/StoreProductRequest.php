<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'        => 'required|unique:products|max:255',
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string',
            'category'    => 'required|string',
            'image_url'   => 'url'
        ];
    }

    /**
     * Transform request to match payload rule
     *
     * @return array<string, mixed>
     */
    protected function prepareForValidation()
    {
        if ($this->has('image')) {
            $this->merge([
                'image_url' => $this->image,
            ]);
        }
    }
}
