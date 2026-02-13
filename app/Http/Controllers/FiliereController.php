<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Exception;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filiere = Filiere::withCount('classes')->orderBy('created_at', 'desc')->paginate(10);
        return view('filieres.index', compact('filieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('filieres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'code' => 'required|string|max:50|unique:filieres,code',
        'nom_filiere' => 'required|string|max:255'
        ]);

        Filiere::create($request->all());

        return redirect()->route('filieres.index')->with('success','Filiere créée avec succès.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Filiere $filiere)
    {
        $filiere->load('classes');
        return view('filieres.show', compact('filiere'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filiere $filiere)
    {
        return view('filieres.edit', compact('filiere'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Filiere $filiere)
    {
        $request->validate([
            'code' => 'required|string|max:50|unique:filieres,code,' . $filiere->id,
            'nom_filiere' => 'required|string|max:255'
        ]);

         $filiere->update($request->all());

         return redirect()->route('filiere.index')->with('success', 'Filiere mise à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filiere $filiere)
    {
        try {
            $filiere->delete();
            return redirect()->route('filieres.index')->with('success', 'Filiere supprimée avec succès.');
        } catch (Exception $e) {
            return redirect()->route('filieres.index')->with('error', 'Impossible de supprimer cette filiere.');
        }
    }
}
