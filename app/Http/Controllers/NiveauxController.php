<?php

namespace App\Http\Controllers;

use App\Models\Categorie_niveaux;
use App\Models\Niveau;
use Exception;
use Illuminate\Http\Request;

class NiveauxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveaux = Niveau::with('categorie')->orderBy('created_at', 'desc')->paginate(10);
        return view('niveaux.index', compact('niveaux'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie_niveaux::all();
        return view('niveaux.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'nom_niveau' => 'required|string|max:255',
        'categorie_niveaux_id' => 'required|exists:categorie_niveaux,id_categorie_niveaux'
        ]);

        Niveau::create($request->all());

        return redirect()->route('niveaux.index')->with('success','Niveau créée avec succès.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Niveau $niveau)
    {
        $niveau->load('categorie');
        return view('niveaux.show', compact('niveaux'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Niveau $niveau)
    {
        $categories = Categorie_niveaux::all();
        return view('niveaux.edit', compact('niveau', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Niveau $niveau)
    {
        $request->validate([
            'nom_niveau' => 'required|string|max:255',
            'categorie_niveaux_id' => 'required|exists:categorie_niveaux,id_categorieNiveaux'

        ]);
         $niveau->update($request->all());

         return redirect()->route('niveaux.index')->with('success', 'niveaux mise à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(niveau $niveau)
    {
        try {
             $niveau->delete();
              return redirect()->route('niveaux.index')->with('success', 'Niveau supprimé avec succès !');
        } catch (Exception $e) {
            return redirect()->route('niveaux.index')->with('error', 'Impossible de supprimer ce niveau.');
        }
    }
}
