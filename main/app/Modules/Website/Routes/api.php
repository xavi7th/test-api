<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Website\Http\Controllers\WebsiteController;

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

Route::prefix('websites')->group(function() {
  Route::post('{website:name}/subscribe', [WebsiteController::class, 'subscribe'])->name('websites.subscribe');
});
