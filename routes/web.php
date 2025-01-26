<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmissionsBotController;

Route::post('/admissions/bot/response', [AdmissionsBotController::class, 'respond']);

Route::get('/', function () {
    return view('welcome');
});
