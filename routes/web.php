<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\RiskController;
use App\Http\Controllers\Admin\ControlController;
use App\Http\Controllers\Admin\MitigationController;
use App\Http\Controllers\Admin\ComplianceFrameworkController;
use App\Http\Controllers\Admin\AssessmentController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PoliciesController;
use App\Http\Controllers\Admin\RisksController;
use App\Http\Controllers\Admin\ControlsController;
use App\Http\Controllers\Admin\MitigationsController;
use App\Http\Controllers\Admin\ComplianceFrameworksController;
use App\Http\Controllers\Admin\AssessmentsController;

/*
|--------------------------------------------------------------------------
| 🌐 Public Routes
|--------------------------------------------------------------------------
*/

// Landing Page (Your GRC “welcome” page)
Route::view('/', 'home')->name('home');
// If your main file is still named welcome.blade.php, use: return view('welcome');


/*
|--------------------------------------------------------------------------
| 🔐 Authenticated Routes (Default Breeze)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| 🧑‍💼 Admin Dashboard Routes (Protected)
|--------------------------------------------------------------------------
|
| All CRUD pages for your GRC entities live here. 
| Requires authentication & email verification.
|
*/

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    // Admin landing page
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

    // CRUD routes for each module
    Route::resource('users', UserController::class);
    Route::resource('policies', PoliciesController::class);
    Route::resource('risks', RisksController::class);
    Route::resource('controls', ControlsController::class);
    Route::resource('mitigations', MitigationsController::class);
    Route::resource('frameworks', ComplianceFrameworksController::class);
    Route::resource('assessments', AssessmentsController::class);
});


/*
|--------------------------------------------------------------------------
| 🚪 Auth Scaffolding (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
