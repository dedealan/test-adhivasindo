<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('users', UserController::class);

    Route::prefix('cari')->group(function () {
        Route::get('/', [SearchController::class,'search'])->name('search');
        Route::get('nama', [SearchController::class,'searchByName'])->name('searchByName');
        Route::get('nim', [SearchController::class,'searchByNim'])->name('searchByNim');
        Route::get('ymd', [SearchController::class,'searchByYmd'])->name('searchByYmd');
    });

    Route::post('auth/logout', [AuthController::class, 'logout']);
});

Route::prefix('auth')->group(function () {
    Route::get('login', function () {
        return response()->json([
            'status' => true,
            'message' => 'Silahkan login.',
        ], 200);
    })->name('login');

    Route::post('login', [AuthController::class, 'login']);
});
