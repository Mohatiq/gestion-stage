<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Page d'accueil → redirige vers les offres
Route::get('/', function () {
    return redirect('/offres');
});

// Dashboard après login
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') return redirect('/admin/dashboard');
    return redirect('/offres');
})->middleware(['auth', 'verified'])->name('dashboard');

// Offres (tout le monde connecté peut voir)
Route::middleware(['auth'])->group(function () {
    Route::resource('offres', OffreController::class);
    Route::resource('candidatures', CandidatureController::class);
});

// Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::patch('/candidatures/{candidature}', [AdminController::class, 'updateCandidature'])->name('candidatures.update');
});

require __DIR__.'/auth.php';