<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\HistoryController;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

Route::middleware('api')->group(function () {
    Route::get('/deals', [DealController::class, 'index']);
    Route::post('/contact', [ContactController::class, 'store']);
    Route::get('/history', [HistoryController::class, 'index']);
});
