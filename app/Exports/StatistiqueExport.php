<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StatistiqueExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->data['produits']);
    }

    public function headings(): array
    {
        return [
            ['STATISTIQUES STOCKMASTER'],
            ['Exporté le : ' . $this->data['date_export']],
            [],
            ['RÉSUMÉ GÉNÉRAL'],
            ['Total Mouvements', $this->data['totalMouvements']],
            ['Entrées Aujourd\'hui', $this->data['entreesToday']],
            ['Sorties Aujourd\'hui', $this->data['sortiesToday']],
            ['Produits en Alerte', $this->data['alertes']],
            [],
            ['MOUVEMENTS PAR MOIS'],
            ['Mois', 'Année', 'Entrées', 'Sorties']
        ];
    }

    public function map($produit): array
    {
        return [
            $produit->designation,
            $produit->reference,
            $produit->quantite_stock,
            $produit->mouvements_count ?? 0
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style pour les titres
        $sheet->getStyle('A1:D1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A4:D4')->getFont()->setBold(true);
        $sheet->getStyle('A10:D10')->getFont()->setBold(true);

        // Largeur des colonnes
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
    }
}
