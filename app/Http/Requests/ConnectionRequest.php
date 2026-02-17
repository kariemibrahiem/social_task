<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConnectionRequest extends FormRequest
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

    protected function store(): array
    {
        return [
            'receiver_id' => 'required|exists:users,id',
        ];
    }

    protected function update(): array
    {
        return [
            'status' => 'required|in:accepted,rejected',
        ];
    }
}
