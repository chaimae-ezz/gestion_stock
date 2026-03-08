@extends('layouts.master')

@section('title', 'Produits en Alerte - StockMaster')

@section('content')
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-lg bg-red-500 flex items-center justify-center mr-4">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3">
                            <h1 class="text-2xl font-bold text-gray-900">Produits en Alerte</h1>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            {{ $produits->total() }} produit(s) critique(s)
                        </span>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">
                            Produits dont le stock est inférieur ou égal au seuil minimum défini
                        </p>
                    </div>
                </div>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-3">
                <a href="{{ route('produits.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Tous les produits
                </a>
                <a href="{{ route('produits.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Nouveau produit
                </a>
            </div>
        </div>

        <!-- Statistiques des alertes -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <!-- Total alertes -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                            <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total alertes</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ $produits->total() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock total critique -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <i class="fas fa-boxes text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Stock critique total</dt>
                                <dd class="text-lg font-semibold text-gray-900">
                                    {{ $produits->sum('quantite_stock') }} unités
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rupture de stock -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-700 rounded-md p-3">
                            <i class="fas fa-times-circle text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Rupture de stock</dt>
                                <dd class="text-lg font-semibold text-gray-900">
                                    {{ $produits->where('quantite_stock', 0)->count() }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stock très bas (< 5) -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-orange-500 rounded-md p-3">
                            <i class="fas fa-arrow-down text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Stock très bas (<5)</dt>
                                <dd class="text-lg font-semibold text-gray-900">
                                    {{ $produits->where('quantite_stock', '<', 5)->count() }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres rapides -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <form method="GET" action="{{ route('produits.alertes') }}" class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                    <!-- Recherche -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                        <input type="text"
                               name="search"
                               id="search"
                               value="{{ request('search') }}"
                               placeholder="Nom du produit..."
                               class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>



                    <!-- Niveau d'alerte -->
                    <div>
                        <label for="niveau" class="block text-sm font-medium text-gray-700 mb-1">Niveau d'alerte</label>
                        <select name="niveau"
                                id="niveau"
                                class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="">Tous</option>
                            <option value="rupture" {{ request('niveau') == 'rupture' ? 'selected' : '' }}>Rupture (0)</option>
                            <option value="critique" {{ request('niveau') == 'critique' ? 'selected' : '' }}>Critique (1-5)</option>
                            <option value="alerte" {{ request('niveau') == 'alerte' ? 'selected' : '' }}>Alerte (6-10)</option>
                        </select>
                    </div>

                    <!-- Boutons -->
                    <div class="flex items-end space-x-2">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700">
                            <i class="fas fa-filter mr-2"></i>
                            Filtrer
                        </button>
                        <a href="{{ route('produits.alertes') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Liste des produits en alerte -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock actuel</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seuil d'alerte</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dernier mouvement</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($produits as $produit)
                        <tr class="hover:bg-red-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-red-100 flex items-center justify-center">
                                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $produit->designation }}</div>
                                        <div class="text-xs text-gray-500">{{ $produit->reference }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-bold {{ $produit->quantite_stock == 0 ? 'text-red-600' : 'text-orange-600' }}">
                                {{ $produit->quantite_stock }} unités
                            </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-600">{{ $produit->seuil_alerte }} unités</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $diff = $produit->seuil_alerte - $produit->quantite_stock;
                                    if ($produit->quantite_stock == 0) {
                                        $status = ['bg-red-600', 'Rupture de stock'];
                                    } elseif ($diff > 5) {
                                        $status = ['bg-red-500', 'Urgent'];
                                    } elseif ($diff > 0) {
                                        $status = ['bg-orange-500', 'Alerte'];
                                    } else {
                                        $status = ['bg-yellow-500', 'Attention'];
                                    }
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white {{ $status[0] }}">
                                {{ $status[1] }}
                            </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @php
                                    $lastMvt = $produit->mouvements()->latest('date_mouvement')->first();
                                @endphp
                                @if($lastMvt)
                                    {{ $lastMvt->date_mouvement->format('d/m/Y') }}
                                    <br>
                                    <span class="text-xs text-gray-400">{{ $lastMvt->type_mouvement }}</span>
                                @else
                                    <span class="text-gray-400">Aucun</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('produits.show', $produit) }}"
                                       class="text-primary-600 hover:text-primary-900 bg-primary-50 hover:bg-primary-100 p-2 rounded-full transition-colors"
                                       title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('produits.edit', $produit) }}"
                                       class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 p-2 rounded-full transition-colors"
                                       title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('mouvements.create', ['produit_id' => $produit->id]) }}"
                                       class="text-green-600 hover:text-green-900 bg-green-50 hover:bg-green-100 p-2 rounded-full transition-colors"
                                       title="Ajouter un mouvement">
                                        <i class="fas fa-plus-circle"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-20 w-20 rounded-full bg-green-100 flex items-center justify-center mb-4">
                                        <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                                    </div>
                                    <p class="text-gray-500 text-lg mb-2">Aucun produit en alerte</p>
                                    <p class="text-gray-400 text-sm mb-4">Tous vos produits ont un stock suffisant</p>
                                    <a href="{{ route('produits.index') }}"
                                       class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700">
                                        <i class="fas fa-box mr-2"></i>
                                        Voir tous les produits
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($produits->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $produits->links() }}
                </div>
            @endif
        </div>

        <!-- Recommandations -->
        @if($produits->count() > 0)
            <div class="mt-8 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-lightbulb text-yellow-600 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">Recommandations</h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Réapprovisionnez les produits en rupture de stock en priorité</li>
                                <li>Préparez des commandes pour les produits avec stock très bas</li>
                                <li>Vérifiez les seuils d'alerte pour éviter les ruptures futures</li>
                                <li>Analysez la fréquence des ventes pour ajuster les quantités</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        // Mise à jour automatique des alertes (optionnel)
        setInterval(function() {
            // Rafraîchir les données sans recharger la page
            console.log('Vérification des alertes...');
        }, 300000); // Toutes les 5 minutes
    </script>
@endpush
