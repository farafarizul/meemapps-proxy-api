<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;

class PageController extends Controller
{
    public function datatable()
    {
        $draw    = intval(request('draw', 0));
        $start   = intval(request('start', 0));
        $length  = intval(request('length', 15));
        $search  = request('search.value', '');

        $query = Page::query();
        $total = Page::count();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('slug', 'like', "%{$search}%")
                  ->orWhere('title', 'like', "%{$search}%");
            });
        }

        $filtered = $query->count();

        $columns  = ['id', 'slug', 'title', 'is_published', null];
        $colIndex = intval(request('order.0.column', 2));
        $colDir   = request('order.0.dir', 'asc') === 'desc' ? 'desc' : 'asc';
        $orderCol = $columns[$colIndex] ?? 'title';
        if ($orderCol) {
            $query->orderBy($orderCol, $colDir);
        }

        $records = $query->skip($start)->take($length)->get();

        $data = $records->map(function ($p) {
            $editUrl   = route('admin.pages.edit', $p);
            $deleteUrl = route('admin.pages.destroy', $p);
            $badge     = $p->is_published
                ? '<span class="badge bg-success">Published</span>'
                : '<span class="badge bg-secondary">Draft</span>';
            $actions   = '<a href="' . $editUrl . '" class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>'
                       . '<button onclick="confirmDelete(\'' . $deleteUrl . '\',\'Delete page: ' . addslashes($p->title) . '?\')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>';

            return [
                'id'      => $p->id,
                'slug'    => '<code>' . e($p->slug) . '</code>',
                'title'   => e($p->title),
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
        $pages = Page::paginate(20);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(PageRequest $request)
    {
        Page::create($request->validated());
        return redirect()->route('admin.pages.index')->with('success', 'Page created.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->validated());
        return redirect()->route('admin.pages.index')->with('success', 'Page updated.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted.');
    }
}
