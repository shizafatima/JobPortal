<?php

use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;

// Route::post('/resume/store', [ResumeController::class, 'store']);

// Route::middleware('auth')->group(function () {
//     Route::post('/resume/save', [ResumeController::class, 'saveResume']);
//     Route::delete('/resume/{resume}', [ResumeController::class, 'delete']);
//     Route::get('/resume/get', [ResumeController::class, 'getResume']);
// });

Route::post('/resume/save', [ResumeController::class, 'saveResume']);
Route::delete('/resume/{resume}', [ResumeController::class, 'delete']);
Route::get('/resume/get', [ResumeController::class, 'getResume']);
