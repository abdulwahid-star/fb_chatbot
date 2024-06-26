<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MessengerController;
use App\Http\Middleware\VerifyBot;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/webhook', [MessengerController::class, 'webhook'])->middleware(VerifyBot::class);

Route::post('/webhook', [MessengerController::class, 'webhook']);