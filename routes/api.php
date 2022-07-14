<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\ProductsController;

Route::prefix('v1')->group(function() {
    Route::apiResource('products', ProductsController::class)
        ->except(['create','show','edit']);
});
