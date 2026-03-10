<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|string|in:hq,branch,reseller',
            'name' => 'required|string|max:255',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:50',
            'whatsapp_url' => 'nullable|url|max:500',
            'map_url' => 'nullable|url|max:500',
            'address' => 'nullable|string',
            'image_path' => 'nullable|string|max:500',
            'sort_order' => 'integer|min:0',
            'is_active' => 'boolean',
        ];
    }
}
