<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            // User fields
            'email'             =>  ['string', 'required', 'email', 'unique:users,email'],
            'contact_number'    =>  ['numeric', 'required', 'unique:users,contact_number'],
            'password'          =>  ['string', 'required', 'confirmed', 'min:8'],
        ];
    }
}
