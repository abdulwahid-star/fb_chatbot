<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MessengerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/webhook', [MessengerController::class, 'webhook']);