<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\TaskController;
use App\Http\Controllers\Web\TechnicianController;
use App\Models\Technician;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth/verify', [AuthController::class, 'verify']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

});
Route::resource('technician', TechnicianController::class);
Route::get('get-technician', [TechnicianController::class, 'getTechnician']);
Route::prefix('tasks')->group(function () {
    Route::get('/pending', [TaskController::class, 'pending'])->name('tasks.pending');
    Route::get('/progress', [TaskController::class, 'progress'])->name('tasks.progress');
    Route::get('/schedule', [TaskController::class, 'schedule'])->name('tasks.schedule');
    Route::get('/report', [TaskController::class, 'report'])->name('tasks.report');
    Route::get('/history', [TaskController::class, 'history'])->name('tasks.history');
    Route::post('/approve/{id}', [TaskController::class, 'approve']);
    Route::post('/finish/{id}', [TaskController::class, 'finish']);
    Route::post('/reject/{id}', [TaskController::class, 'reject']);
    Route::post('/done/{id}', [TaskController::class, 'done']);
    Route::get('/view/{id}', [TaskController::class, 'view']);
    Route::get('/{id}', [TaskController::class, 'show']);
});
