<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Filiere;
use App\Models\Niveau;
use Exception;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classe = Classe::with('Filiere', 'Categorie_niveaux')->orderBy('created_at', 'desc')->paginate(10);
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filieres = Filiere::orderBy('nom_filiere')->get();  // Récupère toutes les filières et tous les niveaux pour les menus déroulants
        $niveaux = Niveau::with('categorie')->orderBy('nom_niveaux')->get();

        return view('classes.create', compact('filieres', 'niveaux'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'nom_classe' => 'required|string|max:255',
        'code_classe' => 'required|string|max:50|unique:classes,code_classe',
        'filiere_id' => 'required|exists:filieres,id_filiere',
        'niveaux_id' => 'required|exists:niveaux,id_niveaux'
        ]);

        Classe::create($request->all());

        return redirect()->route('classes.index')->with('success','classe créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        $classe->load(['filiere', 'niveau.categorie']);
        return view('classees.show', compact('classe'));   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(classe $classe)
    {
        return view('classes.edit', compact('classe', 'filieres', 'niveaux'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, classe $classe)
    {
         $request->validate([
        'nom_classe' => 'required|string|max:255',
        'code_classe' => 'required|string|max:50|unique:classes,code_classe',
        'filiere_id' => 'required|exists:filieres,id_filiere',
        'niveaux_id' => 'required|exists:niveaux,id_niveaux'
        ]);

        $classe->update($request->all());

        return redirect()->route('classes.index')->with('success', 'Classe mise à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(classe $classe)
    {
        try {
            $classe->delete();
            return redirect()->route('classes.index')->with('success', 'classe supprimée avec succès.');
        } catch (Exception $e) {
            return redirect()->route('classes.index')->with('error', 'Impossible de supprimer cette classe.');
        }
    }
}
