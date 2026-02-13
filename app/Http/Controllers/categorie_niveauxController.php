<?php

namespace App\Http\Controllers;

use App\Models\Categorie_niveaux;
use Exception;
use Illuminate\Http\Request;

class categorie_niveauxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie_niveaux::orderBy('created_at', 'desc')->paginate(10);
        return view('categorie_niveaux.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorie_niveaux.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'categories_niveau' => 'required'
        ]);

        Categorie_niveaux::create($request->all());

        return redirect()->route('categorie-niveaux.index')->with('success','Catégorie créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie_niveaux $categorie_niveaux)
    {
        return view('categorie_niveaux.show', compact('categorie_niveaux'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie_niveaux $categorie_niveaux)
    {
        return view('categorie_niveaux.edit', compact('categorie_niveaux'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie_niveaux $categorie_niveaux)
    {
        $request->validate([
            'categories_niveau' => 'required|string|max:255'
        ]);

         $categorie_niveaux->update($request->all());

         return redirect()->route('categorie_niveaux.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie_niveaux $categorie_niveaux)
    {
        try{
            $categorie_niveaux->delete();
            return redirect()->route('categorie_niveaux.index')->with('success', 'Catégorie supprimée avec succès.');
        }catch(Exception $e){
            return redirect()->route('categorie_niveaux.index')->with('error', 'Impossible de supprimer cette catégorie.');
        }
    }
}
