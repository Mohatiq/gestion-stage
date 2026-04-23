<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offre;
use App\Models\Candidature;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalUsers'        => User::count(),
            'totalOffres'       => Offre::count(),
            'totalCandidatures' => Candidature::count(),
            'users'             => User::orderBy('created_at', 'desc')->get(),
            'candidatures'      => Candidature::with(['etudiant', 'offre.societe'])->get(),
        ]);
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé !');
    }

    public function updateCandidature(Request $request, Candidature $candidature)
    {
        $candidature->update(['statut' => $request->statut]);
        return back()->with('success', 'Statut mis à jour !');
    }
}