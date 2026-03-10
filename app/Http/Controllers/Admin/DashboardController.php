<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\Branch;
use App\Models\EndpointConfig;
use App\Models\EndpointJsonOverride;
use App\Models\EventCache;
use App\Models\Page;
use App\Models\Service;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'services' => Service::count(),
            'pages' => Page::count(),
            'branches' => Branch::count(),
            'endpoint_configs' => EndpointConfig::count(),
            'overrides_active' => EndpointJsonOverride::where('is_active', true)->count(),
            'event_caches' => EventCache::count(),
            'app_settings' => AppSetting::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
