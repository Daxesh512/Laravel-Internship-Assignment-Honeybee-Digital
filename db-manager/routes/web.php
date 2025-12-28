<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DuplicateController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// All Directory Management Routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. Dashboard (Using the ReportController to feed stats to the view)
    Route::get('/dashboard', [ReportController::class, 'index'])->name('dashboard');

    // 2. Business CRUD
    Route::resource('businesses', BusinessController::class);

    // 3. Import Module
    Route::get('import', [BusinessController::class, 'importForm'])->name('import.form');
    Route::post('import', [BusinessController::class, 'importProcess'])->name('import.process');

    // 4. Duplicate Management
    Route::get('duplicates', [DuplicateController::class, 'index'])->name('duplicates.index');
    Route::get('duplicates/{id}/compare', [DuplicateController::class, 'compare'])->name('duplicates.compare');
    Route::post('duplicates/merge', [DuplicateController::class, 'merge'])->name('duplicates.merge');

    // 5. Reporting & Exports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');

    // 6. Profile Management (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';