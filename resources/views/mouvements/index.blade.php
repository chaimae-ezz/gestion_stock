@extends('layouts.master')

@section('title', 'Mouvements de Stock - StockMaster')

@section('content')
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-lg bg-primary-600 flex items-center justify-center mr-4">
                        <i class="fas fa-exchange-alt text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Mouvements de Stock</h1>
                        <p class="mt-1 text-sm text-gray-500">Historique complet des entrées et sorties de stock</p>
                    </div>
                </div>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('mouvements.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring ring-primary-300 disabled:opacity-25 transition">
                    <i class="fas fa-plus-circle mr-2"></i>
                    Nouveau Mouvement
                </a>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
            <!-- Total Mouvements -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <i class="fas fa-exchange-alt text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Mouvements</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ $totalMouvements ?? 0 }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-2">
                    <div class="text-sm">
                        <span class="text-gray-500">Depuis le début</span>
                    </div>
                </div>
            </div>

            <!-- Entrées Aujourd'hui -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <i class="fas fa-arrow-down text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Entrées Aujourd'hui</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ $entreesToday ?? 0 }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-2">
                    <div class="text-sm">
                        <span class="text-gray-500">{{ now()->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Sorties Aujourd'hui -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                            <i class="fas fa-arrow-up text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Sorties Aujourd'hui</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ $sortiesToday ?? 0 }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-2">
                    <div class="text-sm">
                        <span class="text-gray-500">{{ now()->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Produits en Alerte -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <i class="fas fa-exclamation-triangle text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Produits en Alerte</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ $alertes ?? 0 }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-2">
                    <div class="text-sm">
                        <span class="text-gray-500">Stock critique</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres et Recherche -->
        <div class="bg-white shadow rounded-lg mb-6">
            <div class="px-4 py-5 sm:p-6">
                <form method="GET" action="{{ route('mouvements.index') }}" class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                    <!-- Recherche -->
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                        <input type="text"
                               name="search"
                               id="search"
                               value="{{ request('search') }}"
                               placeholder="Produit, référence..."
                               class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <!-- Type de mouvement -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                        <select name="type"
                                id="type"
                                class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="">Tous</option>
                            <option value="entree" {{ request('type') == 'entree' ? 'selected' : '' }}>Entrée</option>
                            <option value="sortie" {{ request('type') == 'sortie' ? 'selected' : '' }}>Sortie</option>
                            <option value="ajustement" {{ request('type') == 'ajustement' ? 'selected' : '' }}>Ajustement</option>
                            <option value="inventaire" {{ request('type') == 'inventaire' ? 'selected' : '' }}>Inventaire</option>
                        </select>
                    </div>

                    <!-- Date -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                        <input type="date"
                               name="date"
                               id="date"
                               value="{{ request('date') }}"
                               class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <!-- Boutons -->
                    <div class="flex items-end space-x-2">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring ring-primary-300">
                            <i class="fas fa-filter mr-2"></i>
                            Filtrer
                        </button>
                        <a href="{{ route('mouvements.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tableau des mouvements -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Avant</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Après</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motif</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($mouvements as $mouvement)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $mouvement->date_mouvement->format('d/m/Y') }}<br>
                                <span class="text-xs text-gray-400">{{ $mouvement->date_mouvement->format('H:i') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $mouvement->produit->designation ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-500">{{ $mouvement->produit->reference ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $typeColors = [
                                        'entree' => 'bg-green-100 text-green-800',
                                        'sortie' => 'bg-red-100 text-red-800',
                                        'ajustement' => 'bg-yellow-100 text-yellow-800',
                                        'inventaire' => 'bg-blue-100 text-blue-800',
                                    ];
                                    $typeIcons = [
                                        'entree' => 'fa-arrow-down',
                                        'sortie' => 'fa-arrow-up',
                                        'ajustement' => 'fa-adjust',
                                        'inventaire' => 'fa-clipboard-list',
                                    ];
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $typeColors[$mouvement->type_mouvement] ?? 'bg-gray-100 text-gray-800' }}">
                                <i class="fas {{ $typeIcons[$mouvement->type_mouvement] ?? 'fa-exchange-alt' }} mr-1"></i>
                                {{ ucfirst($mouvement->type_mouvement) }}
                            </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium {{ $mouvement->type_mouvement == 'entree' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $mouvement->type_mouvement == 'entree' ? '+' : '-' }}{{ $mouvement->quantite }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $mouvement->quantite_avant }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary-600">
                                {{ $mouvement->quantite_apres }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 rounded-full bg-primary-100 flex items-center justify-center">
                                    <span class="text-xs font-medium text-primary-800">
                                        {{ strtoupper(substr($mouvement->user->name ?? 'U', 0, 1)) }}
                                    </span>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $mouvement->user->name ?? 'System' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ Str::limit($mouvement->motif, 20) }}</div>
                                @if($mouvement->notes)
                                    <div class="text-xs text-gray-500 mt-1">
                                        <i class="fas fa-sticky-note mr-1"></i>
                                        {{ Str::limit($mouvement->notes, 15) }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('mouvements.show', $mouvement) }}"
                                       class="text-primary-600 hover:text-primary-900 bg-primary-50 hover:bg-primary-100 p-2 rounded-full transition-colors"
                                       title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @can('delete', $mouvement)
                                        <form action="{{ route('mouvements.destroy', $mouvement) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirmDelete('Êtes-vous sûr de vouloir supprimer ce mouvement ?');">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-full transition-colors"
                                                    title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-exchange-alt text-4xl text-gray-300 mb-4"></i>
                                    <p class="text-gray-500 text-lg mb-2">Aucun mouvement enregistré</p>
                                    <p class="text-gray-400 text-sm mb-4">Commencez par créer un nouveau mouvement de stock</p>
                                    <a href="{{ route('mouvements.create') }}"
                                       class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700">
                                        <i class="fas fa-plus-circle mr-2"></i>
                                        Nouveau Mouvement
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($mouvements->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $mouvements->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Styles supplémentaires pour améliorer l'apparence */
        .hover\:bg-gray-50:hover {
            background-color: #f9fafb;
        }
        .transition-colors {
            transition: background-color 0.2s ease;
        }
    </style>
@endpush
