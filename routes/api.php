<?php

use App\Http\Controllers\SyncController;
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

Route::post('zoho-crm-get-notified/{user}', [SyncController::class, 'zohoCrmGetNotified']);
Route::post('google-get-notified/{user}', [SyncController::class, 'googleGetNotifies'])->name('google.get.notified');
