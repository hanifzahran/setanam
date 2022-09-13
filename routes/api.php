<?php

use App\Http\Controllers\API\PerawatanAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/keranjang', [\App\Http\Controllers\CartController::class, 'store']);

Route::prefix('v1')->group(function () {
    Route::prefix('perawatan')->group(function () {
        Route::put('/confirm/{historyId}', [PerawatanAPIController::class, 'confirmPerawatan']);
    });
});
