<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return $this->updateRules();
        }

        return $this->storeRules();
    }

    protected function storeRules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    protected function updateRules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $this->route('user'),
            'password' => 'nullable|min:8|confirmed',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}
