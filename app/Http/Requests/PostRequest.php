<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->isMethod('put')) {
            return $this->update();
        } else {
            return $this->store();
        }
    }

    protected function prepareForValidation()
    {
        $userId = auth('admin')->id() ?? auth()->id();
        $this->merge([
            'user_id' => $userId,
        ]);
    }

    protected function store(): array
    {
        return [
            'content' => 'required|string',
            'image' => 'nullable|image',
            'user_id' => 'required|exists:users,id',
        ];
    }

    protected function update(): array
    {
        return [
            'content' => 'required|string',
            'image' => 'nullable|image',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
