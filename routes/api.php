<?php

use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

Route::post('/resume/store', [ResumeController::class, 'store']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/resume/save', [ResumeController::class, 'saveResume']);
});


