<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // CRM Resource Routes
    Route::resource('companies', CompanyController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('leads', LeadController::class);
    Route::resource('deals', DealController::class);
    Route::resource('tasks', TaskController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
