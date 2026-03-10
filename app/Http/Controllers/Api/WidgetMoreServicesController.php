<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\JsonOverrideService;
use Illuminate\Http\JsonResponse;

class WidgetMoreServicesController extends Controller
{
    public function __construct(private JsonOverrideService $overrideService) {}

    public function __invoke(): JsonResponse
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(fn ($s) => [
                'name' => $s->name,
                'icon_url' => $s->icon_path ? asset($s->icon_path) : null,
                'url' => $s->external_url ?? ($s->url ? url($s->url) : null),
            ]);

        $data = ['status' => 'success', 'data' => $services->toArray()];
        $data = $this->overrideService->applyOverride('widget-more-services', $data);

        return response()->json($data);
    }
}
