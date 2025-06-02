<?php

use App\Http\Controllers\Admin\ActorController;
use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\DirectorController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\User\UserAccountController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [MovieController::class, 'index'])->name('home');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');
// Review submission route (for authenticated users)
Route::post('/movies/{movie}/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');


// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group for authenticated and verified users
Route::middleware(['auth', 'verified'])->group(function () {

    // User-only routes
    Route::middleware(IsUser::class)->group(function () {
        // User dashboard
        Route::get('/user/dashboard', [DashboardController::class, 'userDashboard'])->name('user.dashboard');

        // User account management
        Route::prefix('account')->name('user.account.')->group(function () {
            Route::get('/', [UserAccountController::class, 'show'])->name('show');
            Route::get('/edit', [UserAccountController::class, 'edit'])->name('edit');
            Route::put('/', [UserAccountController::class, 'update'])->name('update');
            Route::delete('/', [UserAccountController::class, 'destroy'])->name('destroy');
        });
    });

    // Admin-only routes
    Route::middleware(IsAdmin::class)->prefix('admin')->name('admin.')->group(function () {

        // Admin dashboard
        Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');

        // Admin account management
        Route::prefix('account')->name('account.')->group(function () {
            Route::get('/', [AdminAccountController::class, 'show'])->name('show');
            Route::get('/edit', [AdminAccountController::class, 'edit'])->name('edit');
            Route::put('/update', [AdminAccountController::class, 'update'])->name('update');
            Route::delete('/delete', [AdminAccountController::class, 'destroy'])->name('destroy');
        });

        // Admin manage users
        Route::resource('users', UserController::class)->names('users');

        // Admin manage movies
        Route::resource('movies', AdminMovieController::class)->names('movies');
        Route::resource('actors', ActorController::class)->names('actors');
        Route::resource('genres', GenreController::class)->names('genres');
        Route::resource('directors', DirectorController::class)->names('directors');

    });
});
