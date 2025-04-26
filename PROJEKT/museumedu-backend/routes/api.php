<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ItemController;

Route::get('/themes', [ThemeController::class, 'index']);
Route::post('/themes', [ThemeController::class, 'store']);
Route::delete('/themes/{id}', [ThemeController::class, 'destroy']);

Route::get('/items', [ItemController::class, 'index']);
Route::post('/items', [ItemController::class, 'store']);
Route::delete('/items/{id}/image', [ItemController::class, 'destroyImage']);
Route::delete('/items/{id}', [ItemController::class, 'destroy']);
