<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
{
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['nullable', 'string'],
            'bank_account_number' => ['required', 'numeric'],
            'about' => ['nullable', 'string', 'max:1000']
        ];
    }
}
