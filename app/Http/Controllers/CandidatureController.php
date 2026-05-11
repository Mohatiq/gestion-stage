<?php
namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Offre;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    // Côté étudiant — voir ses candidatures
    public function index()
    {
        $candidatures = Candidature::where('user_id', auth()->id())
                        ->with('offre')
                        ->get();
        return view('candidatures.index', compact('candidatures'));
    }

    // Formulaire postuler
    public function create(Request $request)
    {
        $offre = Offre::findOrFail($request->offre_id);
        return view('candidatures.create', compact('offre'));
    }

    // Sauvegarder candidature
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'etudiant') {
            abort(403, 'Seuls les étudiants peuvent postuler.');
        }
        $request->validate([
            'offre_id' => 'required|exists:offres,id',
            'message'  => 'required|string|min:10',
        ]);

        $existe = Candidature::where('user_id', auth()->id())
                             ->where('offre_id', $request->offre_id)
                             ->exists();

        if ($existe) {
            return back()->with('error', 'Tu as déjà postulé à cette offre !');
        }
        try {
            Candidature::create([
                'user_id'  => auth()->id(),
                'offre_id' => $request->offre_id,
                'message'  => $request->message,
                'statut'   => 'en_attente',
        ]);
        return redirect('/candidatures')->with('success', 'Candidature envoyée !');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }
       

    // Côté société — voir les candidatures reçues
    public function recues()
    {
        $offres = Offre::where('societe_id', auth()->id())
                  ->with(['candidatures.etudiant'])
                  ->get();

        return view('candidatures.recues', compact('offres'));
    }

    // Côté société — accepter ou refuser
    public function decider(Request $request, Candidature $candidature)
    {
        $request->validate([
            'statut' => 'required|in:acceptee,refusee'
        ]);

        $candidature->update(['statut' => $request->statut]);

        return back()->with('success', 'Décision enregistrée !');
    }
}