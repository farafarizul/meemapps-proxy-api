<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EndpointJsonOverrideRequest;
use App\Models\EndpointConfig;
use App\Models\EndpointJsonOverride;
use App\Services\GssPriceHistoryService;
use App\Services\GssPriceTableService;
use App\Services\JsonOverrideService;
use Illuminate\Http\Request;

class EndpointJsonOverrideController extends Controller
{
    public function index()
    {
        $overrides = EndpointJsonOverride::paginate(20);
        $endpointKeys = ['customer-profile', 'gss-price-history', 'gss-price-table', 'widget-more-services'];
        return view('admin.endpoint-overrides.index', compact('overrides', 'endpointKeys'));
    }

    public function edit(EndpointJsonOverride $endpointOverride)
    {
        $endpointKeys = ['customer-profile', 'gss-price-history', 'gss-price-table', 'widget-more-services'];
        return view('admin.endpoint-overrides.edit', compact('endpointOverride', 'endpointKeys'));
    }

    public function update(EndpointJsonOverrideRequest $request, EndpointJsonOverride $endpointOverride)
    {
        $data = $request->validated();
        $data['override_json'] = $data['override_json'] ? json_decode($data['override_json'], true) : null;
        $data['is_active'] = $request->boolean('is_active');
        $endpointOverride->update($data);

        return redirect()->route('admin.endpoint-overrides.index')->with('success', 'Override updated.');
    }

    public function store(EndpointJsonOverrideRequest $request)
    {
        $data = $request->validated();
        $data['override_json'] = $data['override_json'] ? json_decode($data['override_json'], true) : null;
        $data['is_active'] = $request->boolean('is_active');

        $override = EndpointJsonOverride::updateOrCreate(
            ['endpoint_key' => $data['endpoint_key']],
            $data
        );

        return redirect()->route('admin.endpoint-overrides.edit', $override)
            ->with('success', 'Override saved.');
    }

    public function preview(Request $request, EndpointJsonOverride $endpointOverride)
    {
        $overrideJson = $request->input('override_json');
        $mergeStrategy = $request->input('merge_strategy', 'merge');

        $overrideData = json_decode($overrideJson, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON: '.json_last_error_msg()], 422);
        }

        $base = ['preview' => true, 'endpoint' => $endpointOverride->endpoint_key, 'sample_key' => 'sample_value'];

        if ($mergeStrategy === 'replace') {
            $result = $overrideData;
        } else {
            $result = array_merge($base, $overrideData ?? []);
        }

        return response()->json(['preview' => $result]);
    }

    public function reset(EndpointJsonOverride $endpointOverride)
    {
        $endpointOverride->update(['override_json' => null, 'is_active' => false]);
        return redirect()->route('admin.endpoint-overrides.edit', $endpointOverride)
            ->with('success', 'Override reset to default.');
    }

    public function create()
    {
        $endpointKeys = ['customer-profile', 'gss-price-history', 'gss-price-table', 'widget-more-services'];
        $endpointOverride = new EndpointJsonOverride();
        return view('admin.endpoint-overrides.edit', compact('endpointOverride', 'endpointKeys'));
    }
}
