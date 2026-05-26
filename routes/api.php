<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MediaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Login Endpoint
Route::post('/login', [AuthController::class, 'login']);
// Register Endpoint
Route::post('/register', [AuthController::class, 'register']);
// Media Search Endpoint
Route::middleware('auth:api')->get('/media', [MediaController::class, 'index']);
