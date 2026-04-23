<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Page d'accueil
Route::get('/', function () {
    if (auth()->check()) return redirect('/offres');
    return view('welcome');
});

// Dashboard après login
Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    if ($role === 'admin') return redirect('/admin/dashboard');
    return redirect('/offres');
})->middleware(['auth', 'verified'])->name('dashboard');

// Offres — liste (tout le monde connecté)
Route::middleware(['auth'])->group(function () {
    Route::get('/offres', [OffreController::class, 'index'])->name('offres.index');
});

// Candidatures société — AVANT tout pour éviter conflits
Route::middleware(['auth', 'societe'])->group(function () {
    Route::get('/candidatures/recues', [CandidatureController::class, 'recues'])->name('candidatures.recues');
    Route::patch('/candidatures/{candidature}/decider', [CandidatureController::class, 'decider'])->name('candidatures.decider');
});

// Offres société — create AVANT {offre}
Route::middleware(['auth', 'societe'])->group(function () {
    Route::get('/offres/create', [OffreController::class, 'create'])->name('offres.create');
    Route::post('/offres', [OffreController::class, 'store'])->name('offres.store');
    Route::get('/offres/{offre}/edit', [OffreController::class, 'edit'])->name('offres.edit');
    Route::put('/offres/{offre}', [OffreController::class, 'update'])->name('offres.update');
    Route::delete('/offres/{offre}', [OffreController::class, 'destroy'])->name('offres.destroy');
});

// Offres — voir détail (tout le monde connecté)
Route::middleware(['auth'])->group(function () {
    Route::get('/offres/{offre}', [OffreController::class, 'show'])->name('offres.show');
});

// Candidatures étudiant — resource APRÈS recues
Route::middleware(['auth'])->group(function () {
    Route::resource('candidatures', CandidatureController::class)->except(['index']);
    Route::get('/candidatures', [CandidatureController::class, 'index'])->name('candidatures.index');
});

// Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::patch('/candidatures/{candidature}', [AdminController::class, 'updateCandidature'])->name('candidatures.update');
});

require __DIR__.'/auth.php';