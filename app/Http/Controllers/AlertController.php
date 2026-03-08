<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $query = Produit::whereColumn('quantite_stock', '<=', 'seuil_alerte');

        // Filtre par recherche
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('designation', 'like', '%' . $request->search . '%')
                    ->orWhere('reference', 'like', '%' . $request->search . '%');
            });
        }


        // Filtre par niveau d'alerte
        if ($request->filled('niveau')) {
            switch($request->niveau) {
                case 'rupture':
                    $query->where('quantite_stock', 0);
                    break;
                case 'critique':
                    $query->whereBetween('quantite_stock', [1, 5]);
                    break;
                case 'alerte':
                    $query->whereBetween('quantite_stock', [6, 10]);
                    break;
            }
        }

        $produits = $query->with('mouvements')->paginate(15);



        return view('produits.alertes', compact('produits', ));

    }
}
