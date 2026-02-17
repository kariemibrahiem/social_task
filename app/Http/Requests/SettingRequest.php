<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->isMethod('put') ? $this->update() : $this->store();
    }

    protected function store(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    protected function update(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trns('The site name is required.'),
            'name.string' => trns('The site name must be a valid string.'),
            'logo.image' => trns('The logo must be an image.'),
            'logo.mimes' => trns('The logo must be a file of type: jpg, jpeg, png, webp.'),
            'logo.max' => trns('The logo may not be greater than 2MB.'),
        ];
    }
}
