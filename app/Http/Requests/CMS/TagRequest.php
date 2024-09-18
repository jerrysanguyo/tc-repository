<?php

namespace App\Http\Requests\CMS;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'  =>  [
                'required',
                'string',
                'max:255',
                Rule::unique('tags', 'name')
                    ->ignore($this->route('Tag') ? $this->route('Tag')->id : NULL),
            ],
            'remarks'   =>  [],
        ];
    }
}
