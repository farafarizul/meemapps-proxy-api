<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventCache;

class EventCacheController extends Controller
{
    public function index()
    {
        $caches = EventCache::orderByDesc('event_date')->paginate(30);
        return view('admin.event-caches.index', compact('caches'));
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
