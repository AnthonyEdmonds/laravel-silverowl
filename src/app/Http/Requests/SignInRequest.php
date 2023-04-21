<?php

namespace AnthonyEdmonds\SilverOwl\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string|between:1,191',
            'password' => 'required|string|between:1,191',
        ];
    }
}
