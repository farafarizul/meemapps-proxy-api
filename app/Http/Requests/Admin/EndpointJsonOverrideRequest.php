<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EndpointJsonOverrideRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'endpoint_key' => 'required|string|max:100',
            'merge_strategy' => 'required|in:merge,replace',
            'override_json' => ['nullable', 'string', function ($attr, $val, $fail) {
                if ($val && json_decode($val) === null && json_last_error() !== JSON_ERROR_NONE) {
                    $fail('Override JSON must be valid JSON.');
                }
            }],
            'is_active' => 'boolean',
        ];
    }
}
