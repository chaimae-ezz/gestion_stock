<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Models\Produit;

class FournisseurController extends Controller
{
    public function index()
    {
        $fournisseurs = Fournisseur::withCount('produits')->paginate(10);
        $moyenneProduits = Fournisseur::has('produits')
            ->withCount('produits')
            ->get()
            ->avg('produits_count');
        return view('fournisseurs.index', compact('fournisseurs', 'moyenneProduits'));
    }

    public function create()
    {
        return view('fournisseurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
        ]);

        Fournisseur::create($request->all());

        return redirect()->route('fournisseurs.index')
            ->with('success', 'Fournisseur ajouté avec succès');
    }

    public function show(Fournisseur $fournisseur)
    {
        return view('fournisseurs.show', compact('fournisseur'));
    }

    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    public function update(Request $request, Fournisseur $fournisseur)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string',
        ]);

        $fournisseur->update($request->all());

        return redirect()->route('fournisseurs.index')
            ->with('success', 'Fournisseur modifié avec succès');
    }

    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();

        return redirect()->route('fournisseurs.index')
            ->with('success', 'Fournisseur supprimé');
    }
}
