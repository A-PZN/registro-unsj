<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnimalController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuarios', [UserController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/animales',[AnimalController::class,'index'])->name('animales.index');
Route::get('animales/create',[AnimalController::class, 'create'])->name('animales.create');
Route::post('animales', [AnimalController::class, 'store'])->name('animales.store');
Route::get('animales/{id}/edit', [AnimalController::class, 'edit'])->name('animales.edit');
Route::put('animales/{id}', [AnimalController::class, 'update'])->name('animales.update');
Route::delete('animales/{id}', [AnimalController::class, 'destroy'])->name('animales.destroy');






