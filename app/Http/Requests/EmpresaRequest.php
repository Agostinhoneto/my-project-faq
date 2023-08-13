<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EmpresaRequest extends FormRequest
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
            'nome'         => ['required'],
            'nome_social'  => ['required'],
            'razao_social' => ['required'],
            'cnpj'         => ['required'],
            'telefone'     => ['required'], 
            'email'        => ['required','min:3','email','unique:empresas']
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
            'nome.required' => 'O campo nome é obrigatório.',
            'nome_social.required' => 'O campo nome é obrigatório.',
            'razao_social.required' => 'O campo nome é obrigatório.',
            'cnpj.required' => 'O campo nome é obrigatório.',
            'telefone.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo nome é obrigatório.',
        ];
    }
}
