@extends('layouts.master')
@section('title', 'Tableau de Bord - Statistiques')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- En-tête -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        <i class="fas fa-chart-line text-blue-600 mr-3"></i>
                        Tableau de Bord
                    </h1>
                    <p class="text-gray-600 mt-2">Analyse et statistiques de votre gestion de stock</p>
                </div>
                <div class="flex space-x-3">
                    <button onclick="window.print()"
                            class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition flex items-center">
                        <i class="fas fa-print mr-2"></i>
                        Imprimer
                    </button>

                    <a href="{{ route('statistique.excel') }}"
                       class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center">
                        <i class="fas fa-file-excel mr-2"></i>
                        Export Excel
                    </a>

                    <a href="{{ route('statistique.pdf') }}"
                       class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition flex items-center">
                        <i class="fas fa-file-pdf mr-2"></i>
                        Export PDF
                    </a>
                </div>
            </div>
        </div>

        <!-- Cartes de statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Mouvements -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-2xl shadow-xl p-6 transform hover:-translate-y-1 transition">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Mouvements</p>
                        <h2 class="text-4xl font-bold mt-2">{{ number_format($totalMouvements) }}</h2>
                        <p class="text-blue-200 text-sm mt-2">Depuis le début</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-full">
                        <i class="fas fa-exchange-alt text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-blue-400/30">
                    <div class="flex items-center text-sm">
                        <i class="fas fa-arrow-up mr-2"></i>
                        <span>Dernière mise à jour : {{ now()->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Entrées Aujourd'hui -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-2xl shadow-xl p-6 transform hover:-translate-y-1 transition">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Entrées Aujourd'hui</p>
                        <h2 class="text-4xl font-bold mt-2">{{ number_format($entreesToday) }}</h2>
                        <p class="text-green-200 text-sm mt-2">Unités reçues</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-full">
                        <i class="fas fa-arrow-down text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-green-400/30">
                    <div class="flex items-center text-sm">
                        <i class="fas fa-calendar-day mr-2"></i>
                        <span>Date : {{ now()->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Sorties Aujourd'hui -->
            <div class="bg-gradient-to-r from-orange-500 to-amber-600 text-white rounded-2xl shadow-xl p-6 transform hover:-translate-y-1 transition">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-orange-100 text-sm font-medium">Sorties Aujourd'hui</p>
                        <h2 class="text-4xl font-bold mt-2">{{ number_format($sortiesToday) }}</h2>
                        <p class="text-orange-200 text-sm mt-2">Unités sorties</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-full">
                        <i class="fas fa-arrow-up text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-orange-400/30">
                    <div class="flex items-center text-sm">
                        <i class="fas fa-calendar-day mr-2"></i>
                        <span>Date : {{ now()->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Produits en Alerte -->
            <div class="bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-2xl shadow-xl p-6 transform hover:-translate-y-1 transition">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-red-100 text-sm font-medium">Produits en Alerte</p>
                        <h2 class="text-4xl font-bold mt-2">{{ number_format($alertes) }}</h2>
                        <p class="text-red-200 text-sm mt-2">Stock critique</p>
                    </div>
                    <div class="bg-white/20 p-3 rounded-full">
                        <i class="fas fa-exclamation-triangle text-2xl"></i>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-red-400/30">
                    <div class="flex items-center text-sm">
                        <i class="fas fa-bell mr-2"></i>
                        <span>Nécessite réapprovisionnement</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphiques et Analyse -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Graphique Entrées/Sorties -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-chart-bar text-blue-600 mr-2"></i>
                        Évolution Mensuelle
                    </h3>
                    <div class="flex space-x-2">
                        <button class="text-sm px-3 py-1 bg-blue-100 text-blue-600 rounded-full">
                            Entrées
                        </button>
                        <button class="text-sm px-3 py-1 bg-red-100 text-red-600 rounded-full">
                            Sorties
                        </button>
                    </div>
                </div>

                <!-- Graphique -->
                <div class="h-64">
                    <canvas id="movementChart"></canvas>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-4">
                    <div class="text-center p-4 bg-blue-50 rounded-xl">
                        <p class="text-sm text-gray-600">Moyenne Entrées</p>
                        <p class="text-2xl font-bold text-blue-600">
                            {{ number_format($mouvementsParMois->avg('entrees'), 0) }}
                        </p>
                    </div>
                    <div class="text-center p-4 bg-red-50 rounded-xl">
                        <p class="text-sm text-gray-600">Moyenne Sorties</p>
                        <p class="text-2xl font-bold text-red-600">
                            {{ number_format($mouvementsParMois->avg('sorties'), 0) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Top Produits -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-boxes text-purple-600 mr-2"></i>
                        Top 5 des Produits
                    </h3>
                    <span class="text-sm text-gray-500">Mouvements ce mois</span>
                </div>

                <div class="space-y-4">
                    @php
                        $topProduits = \App\Models\MouvementStock::select('produit_id')
                            ->selectRaw('COUNT(*) as total_mouvements')
                            ->whereMonth('date_mouvement', now()->month)
                            ->groupBy('produit_id')
                            ->orderByDesc('total_mouvements')
                            ->limit(5)
                            ->with('produit')
                            ->get();
                    @endphp

                    @foreach($topProduits as $index => $mouvement)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center font-bold mr-4">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $mouvement->produit->designation ?? 'Produit inconnu' }}</h4>
                                    <p class="text-sm text-gray-500">{{ $mouvement->produit->reference ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-lg font-bold text-gray-800">{{ $mouvement->total_mouvements }}</span>
                                <p class="text-sm text-gray-500">mouvements</p>
                            </div>
                        </div>
                    @endforeach

                    @if($topProduits->isEmpty())
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-chart-pie text-4xl mb-4 text-gray-300"></i>
                            <p>Aucune donnée disponible pour ce mois</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Derniers mouvements -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-history text-green-600 mr-2"></i>
                    Derniers Mouvements
                </h3>
                <a href="{{ route('mouvements.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    Voir tout <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                    <tr class="border-b">
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Date</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Produit</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Type</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Quantité</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">Utilisateur</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $recentMouvements = \App\Models\MouvementStock::with(['produit', 'user'])
                            ->latest('date_mouvement')
                            ->limit(8)
                            ->get();
                    @endphp

                    @foreach($recentMouvements as $mouvement)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-4 py-4 whitespace-nowrap">
                                {{ $mouvement->date_mouvement->format('d/m H:i') }}
                            </td>
                            <td class="px-4 py-4">
                                <div class="font-medium">{{ $mouvement->produit->designation ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500">{{ $mouvement->produit->reference ?? '' }}</div>
                            </td>
                            <td class="px-4 py-4">
                                @php
                                    $badgeClass = match($mouvement->type_mouvement) {
                                        'entree' => 'bg-green-100 text-green-800',
                                        'sortie' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $badgeClass }}">
                                {{ ucfirst($mouvement->type_mouvement) }}
                            </span>
                            </td>
                            <td class="px-4 py-4">
                            <span class="font-bold {{ $mouvement->type_mouvement == 'entree' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $mouvement->type_mouvement == 'entree' ? '+' : '-' }}
                                {{ $mouvement->quantite }}
                            </span>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center mr-3 font-bold text-gray-700">
                                        {{ strtoupper(substr($mouvement->user->name ?? 'S', 0, 1)) }}
                                    </div>
                                    <span class="text-gray-700">{{ $mouvement->user->name ?? 'Système' }}</span>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if($recentMouvements->isEmpty())
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                Aucun mouvement récent
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Résumé global -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-6 border border-indigo-100">
                <div class="flex items-center mb-4">
                    <div class="bg-indigo-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-tachometer-alt text-indigo-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Performance</h4>
                        <p class="text-sm text-gray-600">Évaluation mensuelle</p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-indigo-700 mb-2">
                        {{ round(($entreesToday / max($sortiesToday, 1)) * 100, 1) }}%
                    </div>
                    <p class="text-sm text-gray-600">Ratio Entrées/Sorties</p>
                </div>
            </div>

            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl p-6 border border-emerald-100">
                <div class="flex items-center mb-4">
                    <div class="bg-emerald-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-box text-emerald-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Stock Total</h4>
                        <p class="text-sm text-gray-600">Valeur estimée</p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-emerald-700 mb-2">
                        {{ number_format(\App\Models\Produit::sum('quantite_stock')) }}
                    </div>
                    <p class="text-sm text-gray-600">Unités en stock</p>
                </div>
            </div>

            <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl p-6 border border-amber-100">
                <div class="flex items-center mb-4">
                    <div class="bg-amber-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-users text-amber-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Activité</h4>
                        <p class="text-sm text-gray-600">Utilisateurs actifs</p>
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-amber-700 mb-2">
                        {{ \App\Models\MouvementStock::whereDate('date_mouvement', today())
                            ->distinct('utilisateur_id')
                            ->count('utilisateur_id') }}
                    </div>
                    <p class="text-sm text-gray-600">Utilisateurs aujourd'hui</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Données pour le graphique
        const mouvementData = @json($mouvementsParMois);

        // Préparer les données
        const mois = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
        const entrees = Array(12).fill(0);
        const sorties = Array(12).fill(0);

        mouvementData.forEach(item => {
            if (item.mois >= 1 && item.mois <= 12) {
                entrees[item.mois - 1] = item.entrees;
                sorties[item.mois - 1] = item.sorties;
            }
        });

        // Créer le graphique
        const ctx = document.getElementById('movementChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: mois,
                datasets: [
                    {
                        label: 'Entrées',
                        data: entrees,
                        backgroundColor: 'rgba(59, 130, 246, 0.7)',
                        borderColor: 'rgb(59, 130, 246)',
                        borderWidth: 1,
                        borderRadius: 6,
                        barPercentage: 0.6,
                    },
                    {
                        label: 'Sorties',
                        data: sorties,
                        backgroundColor: 'rgba(239, 68, 68, 0.7)',
                        borderColor: 'rgb(239, 68, 68)',
                        borderWidth: 1,
                        borderRadius: 6,
                        barPercentage: 0.6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 12
                            },
                            padding: 20,
                            usePointStyle: true,
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: { size: 14 },
                        bodyFont: { size: 13 },
                        padding: 12,
                        cornerRadius: 6,
                        displayColors: true,
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    }
                }
            }
        });

        // Fonctions d'export
        function printStats() {
            window.print();
        }

        function exportToExcel() {
            // À implémenter avec votre logique d'export
            alert('Exports Excel à implémenter');
        }

        function exportToPDF() {
            // À implémenter avec votre logique d'export
            alert('Exports PDF à implémenter');
        }

        // Mettre à jour l'heure en temps réel
        function updateTime() {
            const now = new Date();
            document.querySelectorAll('.current-time').forEach(el => {
                el.textContent = now.toLocaleTimeString('fr-FR');
            });
        }

        setInterval(updateTime, 1000);
        updateTime();
    </script>

    <!-- Style d'impression -->
    <style>
        @media print {
            nav, footer, button {
                display: none !important;
            }
            .container {
                margin: 0 !important;
                padding: 0 !important;
            }
            .bg-gradient-to-r {
                background: none !important;
                border: 1px solid #ddd !important;
                color: black !important;
            }
        }
    </style>
@endsection
