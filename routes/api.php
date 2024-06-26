<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MessengerController;
use App\Http\Middleware\VerifyBot;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/webhook', [MessengerController::class, 'webhook'])->middleware(VerifyBot::class);

Route::post('/webhook', [MessengerController::class, 'webhook']);