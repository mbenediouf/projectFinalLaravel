<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;

class RegisterUser extends FormRequest
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
            'name' =>'required',
            'email' =>'required|unique:users,email',
            'password' =>'required'
        ];
    }

    public function failedValidation(ValidationValidator $validator){

        throw new HttpResponseException(response()->json([
            'success'=>false,
            'status_code'=>422,
            'error'=>true,
            'message'=>'Erreur de validation',
            'errorsList'=>$validator->errors()
        ]));
    }
   

    public function messages()
    {
        return[
            'name.required' =>  'un nom doit etre fourni',
            'email.required' =>  'une adresse mail doit etre fourni',
            'email.unique' =>  'cette adresse mail existe deja',
            'password.required' =>  'le mot de pass est requis',
        ];
    }
}
