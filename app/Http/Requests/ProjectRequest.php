<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'partner_id' => 'nullable|exists:partners,id',
            'collaborator_ids' => 'nullable|array',
            'collaborator_ids.*' => 'exists:collaborators,id',
        ];
    }

    protected function update(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
            'partner_id' => 'nullable|exists:partners,id',
            'collaborator_ids' => 'nullable|array',
            'collaborator_ids.*' => 'exists:collaborators,id',
        ];
    }
}