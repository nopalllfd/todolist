<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/tasks/{id}/done', [TaskStatusController::class, 'markAsDone'])->name('tasks.done');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
Route::resource('tasks', TaskController::class)->middleware('auth');
Route::resource('tasks', TaskController::class);
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::post('/tes', [TaskController::class, 'tes'])->name('tes');
