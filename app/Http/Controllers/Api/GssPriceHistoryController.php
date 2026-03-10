<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GssPriceHistoryService;
use App\Services\JsonOverrideService;
use Illuminate\Http\JsonResponse;

class GssPriceHistoryController extends Controller
{
    public function __construct(
        private GssPriceHistoryService $service,
        private JsonOverrideService $overrideService,
    ) {}

    public function __invoke(): JsonResponse
    {
        $data = $this->service->getHistory();
        $data = $this->overrideService->applyOverride('gss-price-history', $data);

        return response()->json($data);
    }
}
