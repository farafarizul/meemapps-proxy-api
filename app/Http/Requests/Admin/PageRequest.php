<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $slugRule = 'required|string|max:255|unique:pages,slug';
        if ($this->route('page')) {
            $slugRule .= ','.$this->route('page')->id;
        }

        return [
            'slug' => $slugRule,
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'hero_text' => 'nullable|string',
            'content_json' => 'nullable|json',
            'is_published' => 'boolean',
        ];
    }
}
