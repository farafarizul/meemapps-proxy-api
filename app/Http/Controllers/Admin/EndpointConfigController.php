<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EndpointConfig;
use Illuminate\Http\Request;

class EndpointConfigController extends Controller
{
    public function datatable()
    {
        $draw    = intval(request('draw', 0));
        $start   = intval(request('start', 0));
        $length  = intval(request('length', 15));
        $search  = request('search.value', '');

        $query = EndpointConfig::query();
        $total = EndpointConfig::count();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('key', 'like', "%{$search}%")
                  ->orWhere('upstream_url', 'like', "%{$search}%")
                  ->orWhere('http_method', 'like', "%{$search}%");
            });
        }

        $filtered = $query->count();

        $columns  = ['key', 'upstream_url', 'http_method', 'is_active', null];
        $colIndex = intval(request('order.0.column', 0));
        $colDir   = request('order.0.dir', 'asc') === 'desc' ? 'desc' : 'asc';
        $orderCol = $columns[$colIndex] ?? 'key';
        if ($orderCol) {
            $query->orderBy($orderCol, $colDir);
        }

        $records = $query->skip($start)->take($length)->get();

        $data = $records->map(function ($c) {
            $editUrl = route('admin.endpoint-configs.edit', $c);
            $badge   = $c->is_active
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-secondary">Inactive</span>';
            $method  = match($c->http_method) {
                'POST'  => '<span class="badge bg-primary">POST</span>',
                'PUT'   => '<span class="badge bg-warning text-dark">PUT</span>',
                'PATCH' => '<span class="badge bg-info text-dark">PATCH</span>',
                'DELETE'=> '<span class="badge bg-danger">DELETE</span>',
                default => '<span class="badge bg-secondary">GET</span>',
            };
            $actions = '<a href="' . $editUrl . '" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>';

            return [
                'key'        => '<code>' . e($c->key) . '</code>',
                'url'        => '<span class="small text-break">' . e($c->upstream_url) . '</span>',
                'method'     => $method,
                'status'     => $badge,
                'actions'    => $actions,
            ];
        });

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $filtered,
            'data'            => $data,
        ]);
    }

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
