<?php

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

Route::get('/', [DashboardController::class, 'index']);
Route::resource('technician', TechnicianController::class);
Route::get('get-technician', [TechnicianController::class, 'getTechnician']);
Route::prefix('tasks')->group(function () {
    Route::get('/pending', [TaskController::class, 'pending'])->name('tasks.pending');
    Route::get('/progress', [TaskController::class, 'progress'])->name('tasks.progress');
    Route::get('/history', [TaskController::class, 'history'])->name('tasks.history');
    Route::post('/approve/{id}', [TaskController::class, 'approve']);
    Route::post('/reject/{id}', [TaskController::class, 'reject']);
    Route::post('/done/{id}', [TaskController::class, 'done']);
    Route::get('/view/{id}', [TaskController::class, 'view']);
    Route::get('/{id}', [TaskController::class, 'show']);
});
