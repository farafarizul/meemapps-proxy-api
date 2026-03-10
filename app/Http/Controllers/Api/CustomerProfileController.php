<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CustomerProfileService;
use App\Services\JsonOverrideService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerProfileController extends Controller
{
    public function __construct(
        private CustomerProfileService $service,
        private JsonOverrideService $overrideService,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $data = $this->service->getProfile(
            $request->headers->all(),
            $request->query->all(),
            $request->post(),
            $request->method()
        );

        $data = $this->overrideService->applyOverride('customer-profile', $data);

        return response()->json($data);
    }
}
