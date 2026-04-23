<?php
namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    public function index()
    {
        $candidatures = Candidature::where('user_id', auth()->id())
                        ->with('offre')
                        ->get();
        return view('candidatures.index', compact('candidatures'));
    }

    public function create(Request $request)
    {
        $offre = Offre::findOrFail($request->offre_id);
        return view('candidatures.create', compact('offre'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'offre_id' => 'required|exists:offres,id',
            'message'  => 'required|string|min:50|max:2000',
        ]);

        // Vérifier qu'il n'a pas déjà postulé
        $existe = Candidature::where('user_id', auth()->id())
                             ->where('offre_id', $request->offre_id)
                             ->exists();

        if ($existe) {
            return back()->with('error', 'Tu as déjà postulé à cette offre !');
        }

        Candidature::create([
            'user_id'  => auth()->id(),
            'offre_id' => $request->offre_id,
            'message'  => $request->message,
            'statut'   => 'en_attente',
        ]);

        return redirect('/candidatures')->with('success', 'Candidature envoyée !');
    }
}