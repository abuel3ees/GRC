<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// === Admin Controllers ===
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
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
use App\Http\Controllers\Admin\CyberRiskController;

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
| 🔐 Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| 🧑‍💼 Admin Routes — Protected by Spatie Role Middleware
|--------------------------------------------------------------------------
|
| Only users with the "Admin" role (via Spatie) can access these.
| Example: $user->assignRole('Admin');
|
*/
Route::middleware(['auth', 'verified', 'role:Admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // === Core GRC Modules ===
        Route::resource('users', UserController::class);
        Route::resource('policies', PoliciesController::class);
        Route::resource('risks', RisksController::class);
        Route::resource('controls', ControlsController::class);
        Route::resource('mitigations', MitigationsController::class);
        Route::resource('frameworks', ComplianceFrameworksController::class);
        Route::resource('assessments', AssessmentController::class);
        Route::resource('assessment-results', AssessmentResultController::class);
        Route::resource('requirements', ComplianceRequirementController::class);
        Route::resource('risk-controls', RiskControlsController::class);
        Route::resource('roles', RolesController::class);
        Route::resource('cyberrisks', CyberRiskController::class);
        // === Analytics & Settings ===
        Route::resource('analytics', AnalyticsController::class)->only(['index']);

        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings/update', [SettingsController::class, 'update'])->name('settings.update');    
});

/*
|--------------------------------------------------------------------------
| 🧭 (Optional) Manager Routes
|--------------------------------------------------------------------------
|
| Example for another role-based section.
| Users with the "Manager" role only.
|
| Route::middleware(['auth', 'verified', 'role:Manager'])
|     ->prefix('manager')
|     ->name('manager.')
|     ->group(function () {
|         Route::get('/dashboard', [ManagerDashboardController::class, 'index'])
|             ->name('dashboard');
|     });
|
*/

/*
|--------------------------------------------------------------------------
| 🚪 Auth Scaffolding (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
