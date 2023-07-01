<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "category_id"=> ['required'],
            "name"=>['required','string'],
            "price"=>['required','numeric','min:0'],
            "stock"=>['required','numeric','min:1'],
            "description"=>['required'],
            "image" =>['nullable']
        ];
    }
    public function messages()
    {
        return[
            "category_id.required"=>" El Producto debe pertecer a alguna categoria",
            "category_id.required"=>" El Producto debe pertecer a alguna categoria",
            "name.required"=>"El producto debe tener un nombre",
            "stock.required"=>"El stock es requerido",
            "stock.min"=>"El stock debe ser mayor a cero",
            "price.required"=>"El precio es requerido",
            "price.min"=>"El precio debe ser mayor a cero",
            "price.numeric"=>"El precio debe ser numerico",
            "stock.numeric"=>"El stock debe ser numerico",
            "description.required"=>"La descripcion es requerida", 
        ];
    }
}
