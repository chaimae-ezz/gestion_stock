<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Fournisseur;

class ProduitController extends Controller
{


    public function index()
    {
        $produits = Produit::with('fournisseur')->paginate(10);
        return view('produits.index', compact('produits'));
    }

    public function create(Request $request)
    {
        $fournisseurs = Fournisseur::all();
        $selectedFournisseur = $request->query('fournisseur_id');
        return view('produits.create', compact('fournisseurs','selectedFournisseur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reference' => 'required|string|max:50|unique:produits',
            'designation' => 'required|string|max:200',
            'prix' => 'required|numeric|min:0',
            'quantite_stock' => 'required|integer|min:0',
            'seuil_alerte' => 'required|integer|min:0',
            'fournisseur_id' => 'nullable|exists:fournisseurs,id',
        ]);

        Produit::create($request->all());

        return redirect()
            ->route('produits.index')
            ->with('success', 'Produit ajouté avec succès');
    }

    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    public function edit(Produit $produit)
    {
        $fournisseurs = Fournisseur::all();
        return view('produits.edit', compact('produit', 'fournisseurs'));
    }

    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'reference' => 'required|string|max:50|unique:produits,reference,' . $produit->id,
            'designation' => 'required|string|max:200',
            'prix' => 'required|numeric|min:0',
//            'quantite_stock' => 'required|integer|min:0',
            'seuil_alerte' => 'required|integer|min:0',
            'fournisseur_id' => 'nullable|exists:fournisseurs,id',
        ]);

        $produit->update($request->all());

        return redirect()
            ->route('produits.index')
            ->with('success', 'Produit modifié avec succès');
    }

    public function destroy(Produit $produit)
    {
        if ($produit->mouvements()->exists()) {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer ce produit car il contient un historique de mouvements.');
        }
        $produit->delete();

        return redirect()
            ->route('produits.index')
            ->with('success', 'Produit supprimé avec succès');
    }







}
