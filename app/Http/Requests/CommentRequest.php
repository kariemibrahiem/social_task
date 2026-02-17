<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
        $userId = auth('sanctum')->id() ?? auth()->id(); 
        $this->merge([
            'user_id' => $userId,
        ]);
    }

    protected function store(): array
    {
        return [
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string',
            'file'    => 'nullable|file|max:10240', 
            'user_id' => 'required|exists:users,id',
        ];
    }

    protected function update(): array
    {
        return [
            'content' => 'required|string',
            'file'    => 'nullable|file|max:10240',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
