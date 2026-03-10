<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BranchRequest;
use App\Models\Branch;

class BranchController extends Controller
{
    public function datatable()
    {
        $draw    = intval(request('draw', 0));
        $start   = intval(request('start', 0));
        $length  = intval(request('length', 15));
        $search  = request('search.value', '');

        $query = Branch::query();
        $total = Branch::count();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('state', 'like', "%{$search}%")
                  ->orWhere('type', 'like', "%{$search}%");
            });
        }

        $filtered = $query->count();

        $columns  = ['name', 'type', 'city', 'state', 'is_active', null];
        $colIndex = intval(request('order.0.column', 0));
        $colDir   = request('order.0.dir', 'asc') === 'desc' ? 'desc' : 'asc';
        $orderCol = $columns[$colIndex] ?? 'sort_order';
        if ($orderCol) {
            $query->orderBy($orderCol, $colDir);
        }

        $records = $query->skip($start)->take($length)->get();

        $data = $records->map(function ($b) {
            $editUrl   = route('admin.branches.edit', $b);
            $deleteUrl = route('admin.branches.destroy', $b);
            $badge     = $b->is_active
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-secondary">Inactive</span>';
            $typeBadge = match($b->type) {
                'hq'       => '<span class="badge bg-primary">HQ</span>',
                'reseller' => '<span class="badge bg-warning text-dark">Reseller</span>',
                default    => '<span class="badge bg-info text-dark">Branch</span>',
            };
            $actions   = '<a href="' . $editUrl . '" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>'
                       . '<button onclick="confirmDelete(\'' . $deleteUrl . '\',\'Delete branch: ' . addslashes($b->name) . '?\')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>';

            return [
                'name'    => e($b->name),
                'type'    => $typeBadge,
                'city'    => e($b->city ?? '—'),
                'state'   => e($b->state ?? '—'),
                'status'  => $badge,
                'actions' => $actions,
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
        $branches = Branch::orderBy('sort_order')->paginate(20);
        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function store(BranchRequest $request)
    {
        Branch::create($request->validated());
        return redirect()->route('admin.branches.index')->with('success', 'Branch created.');
    }

    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(BranchRequest $request, Branch $branch)
    {
        $branch->update($request->validated());
        return redirect()->route('admin.branches.index')->with('success', 'Branch updated.');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('admin.branches.index')->with('success', 'Branch deleted.');
    }
}
