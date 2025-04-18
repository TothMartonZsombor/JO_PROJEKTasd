<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ItemController;

Route::get('/themes', [ThemeController::class, 'index']);
Route::post('/themes', [ThemeController::class, 'store']);

Route::get('/items', [ItemController::class, 'index']);
Route::post('/items', [ItemController::class, 'store']);
