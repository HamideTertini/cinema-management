<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\EnsureUserIsAdmin;

// Krijimi i përdoruesit
Route::post('register', [AuthController::class, 'register']);
Route::get('movies', [MovieController::class, 'index']);
Route::get('categories', [CategoryController::class, 'index']);
Route::get('movies/{id}', [MovieController::class, 'show']);



// Login dhe logout
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/dashboard/stats', [DashboardController::class, 'dashboardStatistics']);

Route::middleware('auth:sanctum',EnsureUserIsAdmin::class)->group(function () {

    Route::post('movies', [MovieController::class, 'store']);
    Route::put('movies/{id}', [MovieController::class, 'update']);
    Route::delete('movies/{id}', [MovieController::class, 'destroy']);


    // Ruterat për Category
    Route::post('categories', [CategoryController::class, 'store']);
    Route::put('categories/{id}', [CategoryController::class, 'update']);
    Route::delete('categories/{id}', [CategoryController::class, 'destroy']);
});
