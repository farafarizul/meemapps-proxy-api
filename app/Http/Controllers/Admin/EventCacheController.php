<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventCache;

class EventCacheController extends Controller
{
    public function datatable()
    {
        $draw    = intval(request('draw', 0));
        $start   = intval(request('start', 0));
        $length  = intval(request('length', 15));
        $search  = request('search.value', '');

        $query = EventCache::query();
        $total = EventCache::count();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('event_date', 'like', "%{$search}%")
                  ->orWhere('source', 'like', "%{$search}%");
            });
        }

        $filtered = $query->count();

        $columns  = ['event_date', 'source', 'is_valid', 'created_at', null];
        $colIndex = intval(request('order.0.column', 0));
        $colDir   = request('order.0.dir', 'desc') === 'asc' ? 'asc' : 'desc';
        $orderCol = $columns[$colIndex] ?? 'event_date';
        if ($orderCol) {
            $query->orderBy($orderCol, $colDir);
        }

        $records = $query->skip($start)->take($length)->get();

        $data = $records->map(function ($c) {
            $deleteUrl = route('admin.event-caches.destroy', $c);
            $badge     = $c->is_valid
                ? '<span class="badge bg-success">Valid</span>'
                : '<span class="badge bg-secondary">Invalid</span>';
            $actions   = '<button onclick="confirmDelete(\'' . $deleteUrl . '\',\'Delete cache for ' . $c->event_date . '?\')" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>';

            return [
                'event_date' => e($c->event_date),
                'source'     => e($c->source),
                'valid'      => $badge,
                'created'    => $c->created_at?->diffForHumans() ?? '—',
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
        return view('admin.event-caches.index');
    }

    public function destroy(EventCache $eventCache)
    {
        $eventCache->delete();
        return redirect()->route('admin.event-caches.index')->with('success', 'Cache deleted.');
    }

    public function destroyAll()
    {
        EventCache::truncate();
        return redirect()->route('admin.event-caches.index')->with('success', 'All event caches cleared.');
    }
}
