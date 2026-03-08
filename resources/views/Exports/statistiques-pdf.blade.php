<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Statistiques StockMaster</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { color: #4361ee; text-align: center; }
        h2 { color: #7209b7; margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; margin: 15px 0; }
        th { background: #4361ee; color: white; padding: 8px; text-align: left; }
        td { padding: 6px 8px; border-bottom: 1px solid #ddd; }
        .resume { background: #f8f9fa; padding: 15px; border-radius: 5px; }
        .footer { text-align: center; margin-top: 40px; color: #6c757d; font-size: 10px; }
    </style>
</head>
<body>
<h1>Statistiques StockMaster</h1>
<p style="text-align: right;">Exporté le : {{ $date_export }}</p>

<div class="resume">
    <h2>Résumé</h2>
    <p><strong>Total Mouvements:</strong> {{ $totalMouvements }}</p>
    <p><strong>Entrées aujourd'hui:</strong> {{ $entreesToday }}</p>
    <p><strong>Sorties aujourd'hui:</strong> {{ $sortiesToday }}</p>
    <p><strong>Produits en alerte:</strong> {{ $alertes }}</p>
</div>

<h2>Mouvements par mois ({{ $annee }})</h2>
<table>
    <tr><th>Mois</th><th>Entrées</th><th>Sorties</th></tr>
    @foreach($mouvementsParMois as $m)
        <tr>
            <td>{{ $months[$m->mois-1] ?? 'Mois '.$m->mois }}</td>
            <td>{{ $m->entrees }}</td>
            <td>{{ $m->sorties }}</td>
        </tr>
    @endforeach
</table>

<h2>Top Produits</h2>
<table>
    <tr><th>Produit</th><th>Référence</th><th>Stock</th><th>Mouvements</th></tr>
    @foreach($produits as $p)
        <tr>
            <td>{{ $p->designation }}</td>
            <td>{{ $p->reference }}</td>
            <td>{{ $p->quantite_stock }}</td>
            <td>{{ $p->mouvements_count ?? 0 }}</td>
        </tr>
    @endforeach
</table>

<div class="footer">
    <p>StockMaster - {{ date('Y') }}</p>
</div>
</body>
</html>
