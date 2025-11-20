<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\SeekerController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth', 'verified', 'role:recruiter'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');

    Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/myJobs', [JobController::class, 'myJobs'])->name('jobs.myJobs');
    Route::get('/jobs/edit/{job}', [JobController::class, 'edit'])->name('jobs.edit');
    Route::patch('/jobs/{job}', [JobController::class, 'update']);
    Route::delete('/jobs/{job}', [JobController::class, 'delete']);
});


Route::middleware(['auth', 'verified', 'role:jobSeeker'])->group(function () {
        Route::get('/jobSeeker/index', [SeekerController::class, 'index'])->name('jobSeeker.index');
});

require __DIR__ . '/settings.php';
