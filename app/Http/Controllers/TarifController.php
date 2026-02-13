<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Tarif;
use Exception;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarif= Tarif::orderBy('created_at', 'desc')->paginate(10);
        return view('tarifs.index', compact('tarifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarifs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'inscription' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
        'mensualite' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
         'classe_id' => 'required|exists:classes,id_classe',
        ]);

        Tarif::create($request->all());

        return redirect()->route('tarifs.index')->with('success','tarif créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarif $tarif)
    {
         $tarif->load(['classe.filiere', 'classe.niveau']);
        
        return view('tarifs.show', compact('tarif'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarif $tarif)
    {
        $classe = Classe::with(['filiere', 'niveau'])->orderBy('nom_classe')->get();

        return view('tarifs.edit', compact('tarif', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarif $tarif)
    {
        $request->validate([
            'inscription' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'mensualite' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'classe_id' => 'required|exists:classes,id_classe'
        ]);

         $tarif->update($request->all());

          return redirect()->route('tarifs.index')->with('success', 'Tarif modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarif $tarif)
    {
        try {
            $tarif->delete();
             return redirect()->route('tarifs.index')->with('success', 'Tarif supprimé avec succès !');
        } catch (Exception $e) {
            return redirect()->route('tarifs.index')->with('error', 'Erreur lors de la suppression.');
        }
    }
}
