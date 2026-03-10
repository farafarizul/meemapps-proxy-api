<?php

namespace App\Services;

use App\Models\EndpointJsonOverride;

class JsonOverrideService
{
    public function applyOverride(string $endpointKey, array $data): array
    {
        $override = EndpointJsonOverride::where('endpoint_key', $endpointKey)
            ->where('is_active', true)
            ->first();

        if (! $override || empty($override->override_json)) {
            return $data;
        }

        $overrideData = is_array($override->override_json)
            ? $override->override_json
            : json_decode($override->override_json, true);

        if (! is_array($overrideData)) {
            return $data;
        }

        if ($override->merge_strategy === 'replace') {
            return $overrideData;
        }

        return array_merge($data, $overrideData);
    }
}
