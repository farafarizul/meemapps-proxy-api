<?php

use App\Http\Controllers\Api\CustomerProfileController;
use App\Http\Controllers\Api\GssPriceHistoryController;
use App\Http\Controllers\Api\GssPriceTableController;
use App\Http\Controllers\Api\WidgetMoreServicesController;
use Illuminate\Support\Facades\Route;

Route::get('/customer-profile', CustomerProfileController::class);
Route::post('/customer-profile', CustomerProfileController::class);
Route::get('/gss-price-history', GssPriceHistoryController::class);
Route::get('/gss-price-table', GssPriceTableController::class);
Route::get('/widget-more-services', WidgetMoreServicesController::class);
