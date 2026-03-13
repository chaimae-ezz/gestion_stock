<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MouvementStock;
use App\Models\Produit;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\StatistiqueExport;

class StatistiqueController extends Controller
{
    public function index()
    {
        // Totaux
        $totalMouvements = MouvementStock::count();

        $entreesToday = MouvementStock::where('type_mouvement', 'entree')
            ->whereDate('date_mouvement', today())
            ->sum('quantite');

        $sortiesToday = MouvementStock::where('type_mouvement', 'sortie')
            ->whereDate('date_mouvement', today())
            ->sum('quantite');

        $alertes = Produit::whereColumn('quantite_stock', '<=', 'seuil_alerte')->count();

        // Graph Entrées / Sorties par mois
        $mouvementsParMois = MouvementStock::select(
            DB::raw('MONTH(date_mouvement) as mois'),
            DB::raw("SUM(CASE WHEN type_mouvement='entree' THEN quantite ELSE 0 END) as entrees"),
            DB::raw("SUM(CASE WHEN type_mouvement='sortie' THEN quantite ELSE 0 END) as sorties")
        )
            ->whereYear('date_mouvement', date('Y'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        return view('statistique', compact(
            'totalMouvements',
            'entreesToday',
            'sortiesToday',
            'alertes',
            'mouvementsParMois'
        ));
    }

    // Exports Excel
    public function exportExcel()
    {
        try {
            $data = $this->getStatistiquesData();
            return Excel::download(new StatistiqueExport($data), 'statistiques_' . date('Y-m-d') . '.xlsx');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'export Excel : ' . $e->getMessage());
        }
    }

    // Exports PDF
    public function exportPdf()
    {
        try {
            $data = $this->getStatistiquesData();

            $pdf = Pdf::loadView('exports.statistiques-pdf', $data);
            $pdf->setPaper('A4', 'portrait');

            return $pdf->download('statistiques_' . date('Y-m-d') . '.pdf');


        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'export PDF : ' . $e->getMessage());
        }
    }

    /**
     * Récupérer les données pour les exports
     */
    private function getStatistiquesData()
    {
        $totalMouvements = MouvementStock::count();

        $entreesToday = MouvementStock::where('type_mouvement', 'entree')
            ->whereDate('date_mouvement', today())
            ->sum('quantite');

        $sortiesToday = MouvementStock::where('type_mouvement', 'sortie')
            ->whereDate('date_mouvement', today())
            ->sum('quantite');

        $alertes = Produit::whereColumn('quantite_stock', '<=', 'seuil_alerte')->count();

        $mouvementsParMois = MouvementStock::select(
            DB::raw('MONTH(date_mouvement) as mois'),
            DB::raw('YEAR(date_mouvement) as annee'),
            DB::raw("SUM(CASE WHEN type_mouvement='entree' THEN quantite ELSE 0 END) as entrees"),
            DB::raw("SUM(CASE WHEN type_mouvement='sortie' THEN quantite ELSE 0 END) as sorties")
        )
            ->whereYear('date_mouvement', date('Y'))
            ->groupBy('annee', 'mois')
            ->orderBy('annee')
            ->orderBy('mois')
            ->get();

        $produits = Produit::withCount('mouvements')
            ->orderByDesc('mouvements_count')
            ->limit(10)
            ->get();

        return [
            'totalMouvements' => $totalMouvements,
            'entreesToday' => $entreesToday,
            'sortiesToday' => $sortiesToday,
            'alertes' => $alertes,
            'mouvementsParMois' => $mouvementsParMois,
            'produits' => $produits,
            'date_export' => now()->format('d/m/Y H:i:s'),
            'annee' => date('Y')
        ];
    }
}
