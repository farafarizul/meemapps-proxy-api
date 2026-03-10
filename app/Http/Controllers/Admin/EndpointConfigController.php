<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EndpointConfig;
use Illuminate\Http\Request;

class EndpointConfigController extends Controller
{
    public function index()
    {
        $configs = EndpointConfig::paginate(20);
        return view('admin.endpoint-configs.index', compact('configs'));
    }

    public function show(EndpointConfig $endpointConfig)
    {
        return view('admin.endpoint-configs.show', compact('endpointConfig'));
    }

    public function edit(EndpointConfig $endpointConfig)
    {
        return view('admin.endpoint-configs.edit', compact('endpointConfig'));
    }

    public function update(Request $request, EndpointConfig $endpointConfig)
    {
        $validated = $request->validate([
            'upstream_url' => 'required|url',
            'http_method' => 'required|in:GET,POST,PUT,PATCH,DELETE',
            'headers_json' => 'nullable|json',
            'options_json' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        $validated['headers_json'] = $validated['headers_json'] ? json_decode($validated['headers_json'], true) : null;
        $validated['options_json'] = $validated['options_json'] ? json_decode($validated['options_json'], true) : null;
        $validated['is_active'] = $request->boolean('is_active');

        $endpointConfig->update($validated);

        return redirect()->route('admin.endpoint-configs.index')->with('success', 'Config updated.');
    }
}
