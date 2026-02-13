<?php

namespace App\Http\Controllers;

use App\Models\Annee_academique;
use Exception;
use Illuminate\Http\Request;

class Annee_academiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $annee_acamique = Annee_academique::orderBy('created_at', 'desc')->paginate(10);
        return view('annee_academiques.index', compact('annee_academique'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('annee_acamiques.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'annee_academique' => 'required|string|max:9|unique:annee_academiques,annee_academique'
        ]);

        Annee_academique::create($request->all());

        return redirect()->route('annee_academiques.index')->with('success','Année academique créée avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Annee_academique $annee_acamique)
    {
        return view('annee_acamiques.show', compact('annee_academique'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('annee_acamiques.edit', compact('annee_acamiques'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Annee_academique $annee_academique)
    {
        $request->validate([
            'annee_academique' => 'required|string|max:10'
        ]);

        $annee_academique->update($request->all());
        
         return redirect()->route('annnee_academiques.index')->with('success', 'Année académique mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Annee_academique $annee_academique)
    {
        try {
             $annee_academique->delete();
            return redirect()->route('annee_academiques.index')->with('success', 'Année academique supprimée avec succès.');
        } catch (Exception $e) {
            return redirect()->route('annee_academiques.index')->with('error', 'Impossible de supprimer cette année academique.');
        }
    }
}
