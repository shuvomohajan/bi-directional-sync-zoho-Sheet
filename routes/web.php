<?php

use App\Http\Controllers\GoogleSheetsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZohoCrmController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::prefix('task-1')->group(function () {
        Route::view('/', 'task1.index')->name('task.1');
        //Google Sheets
        Route::view('oauth-google-sheets', 'task1.google_sheets')->name('oauth.google.sheets');
        Route::post('oauth-google-sheets', [GoogleSheetsController::class, 'oauthGoogleSheetsAuthorize'])->name('oauth.google.sheets.authorize');
        Route::get('oauth-google-sheets/callback', [GoogleSheetsController::class, 'oauthGoogleSheetsCallback'])->name('oauth.google.sheets.callback');
        //Zoho CRM
        Route::view('oauth-zoho-crm', 'task1.zoho_crm')->name('oauth.zoho.crm');
        Route::post('oauth-zoho-crm', [ZohoCrmController::class, 'oauthZohoCrmAuthorize'])->name('oauth.zoho.crm.authorize');
        Route::get('oauth-zoho-crm/callback', [ZohoCrmController::class, 'oauthZohoCrmCallback'])->name('oauth.zoho.crm.callback');
    });
    
    Route::prefix('task-2')->group(function () {
        Route::put('user-google-sheets-id-update', [UserController::class, 'updateUserGoogleSheetId'])->name('user.google.sheets.id.update');
        //Google Sheets
        Route::view('google-sheets-create', 'task2.google_sheets_create')->name('google.sheets.create');
        Route::post('google-sheets-store', [GoogleSheetsController::class, 'googleSheetsStore'])->name('google.sheets.store');
        //Zoho CRM
        Route::view('zoho-crm-create', 'task2.zoho_crm_create')->name('zoho.crm.create');
        Route::post('zoho-crm-store', [ZohoCrmController::class, 'zohoCrmStore'])->name('zoho.crm.store');
    });
});

require __DIR__ . '/auth.php';
