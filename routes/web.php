<?php

use App\Http\Controllers\BaggageItemController;
use App\Http\Controllers\ScreeningLogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Option A: Redirect the home page directly to the Login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Option B: If you prefer keeping the welcome page instead, uncomment the line below:
// Route::get('/', function () { return view('welcome'); });

// Protected Routes (Accessible only to logged-in users)
Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('baggage-items', BaggageItemController::class)
        ->only(['index', 'create', 'store', 'update']);

    Route::resource('screening-logs', ScreeningLogController::class)
        ->only(['index', 'create', 'store', 'update']);
});

// Authentication Routes (Login, Register, Logout, Password Reset)
require __DIR__.'/auth.php';