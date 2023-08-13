<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserFormRequest extends FormRequest
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
           'name' =>['required','min:3'],
           'email' =>['required','min:3','email','unique:users']
        ];
    }

    
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
    
    public function messages()
    {
        return [
           'name.required' => 'O campo Nome é obrigatório',
           'email.required'  => 'O campo Email é obrigatório',
           'email.email'  => 'O campo Email não é valido', 
           'email.unique'  => 'O campo Email não pode ser repetido',          
        ];
    }
}
