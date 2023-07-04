<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserREquest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'number_id'=>['required','unique:users,number_id','numeric'],
            'name'=>['required','string'],
            'last_name'=>['required','string'],
            'address'=>['required'],
            'cellphone'=>['required','numeric','unique:users,cellphone'],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required','min:8','confirmed'],
            'role'=>['required']
        ];
    }
    public function messages(){
        return[
            'number_id.required'=> 'La cédula es requerida',
            'number_id.numeric'=> 'La cédula debe ser numerica',
            'number_id.unique'=> 'La cédula ya se encuentra registrada',

            'name.required'=>'El nombre es requerido',
            'name.string'=>'El nombre dede ser una palabra',
            
            'last_name.required'=> 'El apellido es requerido',
            'last_name.string'=> 'El apellido debe ser una palabra',

            'address.required'=> 'La dirección es requerida es requerida',

            'cellphone.required'=>'El número de celular es requerido',
            'cellphone.numeric'=>'El campo debe ser numerico',
            'cellphone.unique'=>'El número de celular ya se encuentra asociado a una cuenta',

            'email.required'=>'El email es requerido',
            'email.email'=>'El email no tiene un formato valido',
            'email.unique'=>'El email ya esta asociado a una cuenta',


            'password.required'=>'La contraseña es requerida',
            'password.min'=>'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed'=>'Las contraseñas no coincidenv  ',

            'role.required'=>'El rol es requerido'


        ];
    }
}

