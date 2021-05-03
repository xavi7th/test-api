<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PublicPages\Http\Controllers\PublicPagesController;

Route::prefix('')->group(function () {
  Route::get('/', [PublicPagesController::class, 'index']);
});
