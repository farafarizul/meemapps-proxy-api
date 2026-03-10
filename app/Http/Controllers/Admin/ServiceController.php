<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function datatable()
    {
        $draw    = intval(request('draw', 0));
        $start   = intval(request('start', 0));
        $length  = intval(request('length', 15));
        $search  = request('search.value', '');

        $query = Service::query();
        $total = Service::count();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('url', 'like', "%{$search}%")
                  ->orWhere('external_url', 'like', "%{$search}%");
            });
        }

        $filtered = $query->count();

        $columns  = ['id', 'name', 'url', 'sort_order', 'is_active', null];
        $colIndex = intval(request('order.0.column', 3));
        $colDir   = request('order.0.dir', 'asc') === 'desc' ? 'desc' : 'asc';
        $orderCol = $columns[$colIndex] ?? 'sort_order';
        if ($orderCol) {
            $query->orderBy($orderCol, $colDir);
        }

        $records = $query->skip($start)->take($length)->get();

        $data = $records->map(function ($s) {
            $editUrl   = route('admin.services.edit', $s);
            $deleteUrl = route('admin.services.destroy', $s);
            $name      = e($s->name);
            $badge     = $s->is_active
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-secondary">Inactive</span>';
            $actions   = '<a href="' . $editUrl . '" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>'
                       . '<button onclick="confirmDelete(\'' . $deleteUrl . '\',\'Delete service: ' . addslashes($s->name) . '?\')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>';

            return [
                'id'         => $s->id,
                'name'       => $name,
                'url'        => e($s->url ?? $s->external_url ?? '—'),
                'sort_order' => $s->sort_order,
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
        $services = Service::orderBy('sort_order')->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(ServiceRequest $request)
    {
        Service::create($request->validated());
        return redirect()->route('admin.services.index')->with('success', 'Service created.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->validated());
        return redirect()->route('admin.services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }
}
