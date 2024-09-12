<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'first_name'    =>  ['required', 'string', 'max:255'],
            'middle_name'   =>  ['required', 'string', 'max:255'],
            'last_name'     =>  ['required', 'string', 'max:255'],
            'department_id' =>  ['required', 'integer', 'exists:departments,id'],
        ];
    }
}
