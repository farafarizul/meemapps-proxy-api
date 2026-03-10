<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\GssPriceTableService;
use App\Services\JsonOverrideService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GssPriceTableController extends Controller
{
    public function __construct(
        private GssPriceTableService $service,
        private JsonOverrideService $overrideService,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $filter = $request->query('filter', '7day');
        $data = $this->service->getPriceTable($filter);
        $data = $this->overrideService->applyOverride('gss-price-table', $data);

        return response()->json($data);
    }
}
