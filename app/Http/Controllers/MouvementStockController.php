<?php

namespace App\Http\Controllers;

use App\Models\MouvementStock;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MouvementStockController extends Controller
{

    public function index(Request $request)
    {

        $query = MouvementStock::with(['produit', 'user']);

        //  FILTRE RECHERCHE (par produit ou référence)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('produit', function($q) use ($search) {
                $q->where('designation', 'like', "%{$search}%")
                    ->orWhere('reference', 'like', "%{$search}%");
            });
        }

        //  FILTRE PAR TYPE DE MOUVEMENT
        if ($request->filled('type')) {
            $query->where('type_mouvement', $request->type);
        }

        //  FILTRE PAR DATE
        if ($request->filled('date')) {
            $query->whereDate('date_mouvement', $request->date);
        }

        //  FILTRE PAR PÉRIODE
        if ($request->filled('date_debut')) {
            $query->whereDate('date_mouvement', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('date_mouvement', '<=', $request->date_fin);
        }

        //  FILTRE PAR PRODUIT SPÉCIFIQUE
        if ($request->filled('produit_id')) {
            $query->where('produit_id', $request->produit_id);
        }

        // Exécuter la requête avec pagination (conserve les filtres)
        $mouvements = $query->latest('date_mouvement')
            ->paginate(20)
            ->withQueryString(); // Important pour garder les filtres dans la pagination


        $totalMouvements = MouvementStock::count();

        $entreesToday = MouvementStock::where('type_mouvement', 'entree')
            ->whereDate('date_mouvement', today())
            ->count();

        $sortiesToday = MouvementStock::where('type_mouvement', 'sortie')
            ->whereDate('date_mouvement', today())
            ->count();

        $alertes = Produit::whereColumn('quantite_stock', '<=', 'seuil_alerte')
            ->whereNotNull('seuil_alerte')
            ->count();


        return view('mouvements.index', compact(
            'mouvements',
            'totalMouvements',
            'entreesToday',
            'sortiesToday',
            'alertes'
        ));
    }

    public function create()
    {
        $produits = Produit::orderBy('designation')->get();

        return view('mouvements.create', compact('produits'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'produit_id'     => 'required|exists:produits,id',
            'type_mouvement' => 'required|in:entree,sortie,ajustement,inventaire',
            'quantite'       => 'required|integer|min:1',
            'motif'          => 'nullable|string|max:100',
            'notes'          => 'nullable|string',
        ]);

        try {

            DB::transaction(function () use ($request) {

                $produit = Produit::lockForUpdate()->findOrFail($request->produit_id);

                // CHECK INVENTAIRE MENSUEL
                if ($request->type_mouvement === 'inventaire') {

                    $alreadyDone = MouvementStock::where('produit_id', $produit->id)
                        ->where('type_mouvement', 'inventaire')
                        ->whereMonth('date_mouvement', now()->month)
                        ->whereYear('date_mouvement', now()->year)
                        ->lockForUpdate()
                        ->exists();

                    if ($alreadyDone) {
                        throw new \Exception('Inventaire déjà effectué pour ce produit ce mois-ci.');
                    }
                }

                $quantiteAvant = $produit->quantite_stock;
                $quantite = $request->quantite;

                switch ($request->type_mouvement) {
                    case 'entree':
                        $quantiteApres = $quantiteAvant + $quantite;
                        break;

                    case 'sortie':
                        if ($quantite > $quantiteAvant) {
                            throw new \Exception('Stock insuffisant');
                        }
                        $quantiteApres = $quantiteAvant - $quantite;
                        break;

                    case 'ajustement':
                    case 'inventaire':
                        $quantiteApres = $quantite;
                        break;
                }

                MouvementStock::create([
                    'produit_id' => $produit->id,
                    'type_mouvement' => $request->type_mouvement,
                    'quantite' => $quantite,
                    'quantite_avant' => $quantiteAvant,
                    'quantite_apres' => $quantiteApres,
                    'motif' => $request->motif,
                    'notes' => $request->notes,
                    'utilisateur_id' => Auth::id(),
                    'date_mouvement' => now(),
                ]);

                $produit->update([
                    'quantite_stock' => $quantiteApres
                ]);
            });

            return redirect()
                ->route('mouvements.index')
                ->with('success', 'Mouvement enregistré');

        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }
    public function show(MouvementStock $mouvement)
    {
        $mouvement->load(['produit', 'user']);

        return view('mouvements.show', compact('mouvement'));
    }

}
