<?php
namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\Request;

class OffreController extends Controller
{
    public function index()
    {
        $offres = Offre::with('societe')->get();
        return view('offres.index', compact('offres'));
    }

    public function create()
    {
        return view('offres.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'required|string',
            'ville'       => 'required|string|max:255',
            'duree'       => 'required|integer|min:1',
            'remuneration'=> 'nullable|numeric',
            'date_limite' => 'nullable|date',
        ]);

        Offre::create([
            'titre'        => $request->titre,
            'description'  => $request->description,
            'ville'        => $request->ville,
            'duree'        => $request->duree,
            'remuneration' => $request->remuneration,
            'date_limite'  => $request->date_limite,
            'societe_id'   => auth()->id(),
        ]);

        return redirect('/offres')->with('success', 'Offre créée !');
    }

    public function show(Offre $offre)
    {
        return view('offres.show', compact('offre'));
    }

    public function edit(Offre $offre)
    {
        return view('offres.edit', compact('offre'));
    }

    public function update(Request $request, Offre $offre)
    {
        $request->validate([
            'titre'       => 'required|string|max:255',
            'description' => 'required|string',
            'ville'       => 'required|string|max:255',
            'duree'       => 'required|integer|min:1',
        ]);

        $offre->update($request->only([
            'titre', 'description', 'ville',
            'duree', 'remuneration', 'date_limite'
        ]));

        return redirect('/offres')->with('success', 'Offre modifiée !');
    }

    public function destroy(Offre $offre)
    {
        $offre->delete();
        return redirect('/offres')->with('success', 'Offre supprimée !');
    }
}