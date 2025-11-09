<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// === Admin Controllers ===
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PoliciesController;
use App\Http\Controllers\Admin\RisksController;
use App\Http\Controllers\Admin\ControlsController;
use App\Http\Controllers\Admin\MitigationsController;
use App\Http\Controllers\Admin\ComplianceFrameworksController;
use App\Http\Controllers\Admin\AssessmentController;
use App\Http\Controllers\Admin\AssessmentResultController;
use App\Http\Controllers\Admin\ComplianceRequirementController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\RiskControlsController;

/*
|--------------------------------------------------------------------------
| 🌐 Public Routes
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('home');
Route::view('/solutions', 'pages.solutions')->name('solutions');
Route::view('/platform', 'pages.platform')->name('platform');
Route::view('/resources', 'pages.resources')->name('resources');
Route::view('/company', 'pages.company')->name('company');

/*
|--------------------------------------------------------------------------
| 🔐 Authenticated Routes (Default Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| 🧑‍💼 Admin Dashboard Routes (Protected by Role)
|--------------------------------------------------------------------------
|
| These routes are restricted to authenticated, verified users
| who have the "Admin" role via Spatie Laravel Permission.
|
*/

Route::middleware(['auth', 'verified', 'role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Core Resources
        Route::resource('users', UsersController::class);
        Route::resource('policies', PoliciesController::class);
        Route::resource('risks', RisksController::class);
        Route::resource('controls', ControlsController::class);
        Route::resource('mitigations', MitigationsController::class);
        Route::resource('frameworks', ComplianceFrameworksController::class);
        Route::resource('assessments', AssessmentController::class);
        Route::resource('assessment-results', AssessmentResultController::class);
        Route::resource('compliance-requirements', ComplianceRequirementController::class);
        Route::resource('risk-controls', RiskControlsController::class);
        Route::resource('roles', RolesController::class);

        // Single-page sections
        Route::resource('analytics', AnalyticsController::class)->only(['index']);
        Route::resource('settings', SettingsController::class)->only(['index', 'update']);
    });

/*
|--------------------------------------------------------------------------
| 🚪 Authentication Scaffolding (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
