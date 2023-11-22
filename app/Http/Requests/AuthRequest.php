<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'name' => 'required|max:80',
            'email' => 'email|required|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6|max:12'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Preencha Todos os campos', 
            'email.unique' => 'Email informado já esta sendo usado', 
            'password.min' => 'A senha deve possui no minimo 6 caracteres', 
            'password.max' => 'A senha deve possui no maximo 12 caracteres',
            'email.email' => 'Email Invalido'
        ];
    }
}
