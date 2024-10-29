<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;

// Ruta para las órdenes
Route::resource('orders', OrderController::class);

// Ruta para los usuarios
Route::resource('users', UserController::class);

// Ruta para los estados
Route::resource('statuses', StatusController::class);
