<?php

use App\Http\Controllers\Task1Controller;
use App\Http\Controllers\Task2Controller;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('task-1')->group(function () {
    Route::view('/', 'task1.index')->name('task.1');
    Route::view('oauth-google-sheets', 'task1.google_sheets')->name('oauth.google.sheets');
    Route::post('oauth-google-sheets', [Task1Controller::class, 'oauthGoogleSheetsAuthorize'])->name('oauth.google.sheets.authorize');
    Route::get('oauth-google-sheets/callback', [Task1Controller::class, 'oauthGoogleSheetsCallback'])->name('oauth.google.sheets.callback');

    Route::view('oauth-zoho-crm', 'task1.zoho_crm')->name('oauth.zoho.crm');
    // Route::post('oauth-google-sheets', [Task1Controller::class, 'oauthGoogleSheetsAuthorize'])->name('oauth.google.sheets.authorize');
    // Route::get('oauth-google-sheets/callback', [Task1Controller::class, 'oauthGoogleSheetsCallback'])->name('oauth.google.sheets.callback');
});

Route::prefix('task-2')->group(function () {
    Route::view('/', 'task2.index')->name('task.2');
    Route::post('google-sheets-store', [Task1Controller::class, 'googleSheetsStore'])->name('google.sheets.store');
});

require __DIR__.'/auth.php';
