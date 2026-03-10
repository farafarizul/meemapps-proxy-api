<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'icon_path' => 'nullable|string|max:500',
            'url' => 'nullable|string|max:500',
            'route_name' => 'nullable|string|max:255',
            'external_url' => 'nullable|url|max:500',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
