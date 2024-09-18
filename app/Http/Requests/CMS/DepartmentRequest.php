<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
                'max:255',
                Rule::unique('departments', 'name')
                    ->ignore($this->route('Department') ? $this->route('Department')->id : null),
            ],
            'remarks' => ['string', 'required', 'max:255'],
        ];
    }
}