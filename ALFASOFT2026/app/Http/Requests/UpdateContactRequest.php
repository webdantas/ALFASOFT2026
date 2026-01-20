<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'number' => preg_replace('/\D/', '', $this->number),
        ]);
    }

    public function rules(): array
    {
        return [
            'country_code' => ['required'],
            'number' => [
                'required',
                'digits:9',
                Rule::unique('contacts')
                    ->where(fn ($q) =>
                        $q->where('country_code', $this->country_code)
                    )
                    ->ignore($this->route('contact')->id),
            ],
        ];
    }
}
