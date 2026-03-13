@extends('layouts.master')


@section('title', 'Liste des Produits')

@section('content')
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- En-tête -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-white">
                        <i class="fas fa-boxes mr-2"></i> Liste des Produits
                    </h1>
                    <p class="text-blue-100 mt-1">Gérez votre inventaire de produits</p>
                </div>
                <a href="{{ route('produits.create') }}"
                   class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                    <i class="fas fa-plus mr-2"></i> Nouveau Produit
                </a>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 px-6 py-4 bg-gray-50">
            <div class="bg-white rounded-lg p-4 shadow border-l-4 border-blue-500">
                <div class="flex items-center">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-box text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total Produits</p>
                        <p class="text-2xl font-bold">{{ $produits->total() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg p-4 shadow border-l-4 border-green-500">
                <div class="flex items-center">
                    <div class="bg-green-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">En Stock</p>
                        <p class="text-2xl font-bold">{{ $produits->where('quantite_stock', '>', 0)->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg p-4 shadow border-l-4 border-yellow-500">
                <div class="flex items-center">
                    <div class="bg-yellow-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                    </div>
                    <a href="{{ route('produits.alertes') }}" class="block hover:bg-red-50 p-3 rounded-lg transition-colors">
                        <div>
                            <p class="text-gray-500 text-sm">En Alerte</p>
                            <p class="text-2xl font-bold text-red-600">
                                {{-- $produits->filter(fn($p) => $p->quantite_stock <= $p->seuil_alerte)->count()-- }}
                                {{--  {{ $produits->where('quantite_stock', '<=', 'seuil_alerte')->count() ;--}}
                   {{   $alertes = \App\Models\Produit::whereColumn('quantite_stock', '<=', 'seuil_alerte')->count()}}

                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg p-4 shadow border-l-4 border-red-500">
                <div class="flex items-center">
                    <div class="bg-red-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Rupture</p>
                        <p class="text-2xl font-bold">{{ $produits->where('quantite_stock', 0)->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <i class="fas fa-hashtag mr-1"></i> Référence
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <i class="fas fa-tag mr-1"></i> Désignation
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <i class="fas fa-money-bill mr-1"></i> Prix
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <i class="fas fa-boxes mr-1"></i> Stock
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <i class="fas fa-industry mr-1"></i> Fournisseur
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <i class="fas fa-cogs mr-1"></i> Actions
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($produits as $produit)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-box text-blue-600"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $produit->reference }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-semibold text-gray-900">{{ $produit->designation }}</div>
                            @if($produit->description)
                                <div class="text-sm text-gray-500 truncate max-w-xs">{{ $produit->description }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ number_format($produit->prix, 2) }} MAD
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-32">
                                    <div class="text-sm font-medium text-gray-900 mb-1">
                                        {{ $produit->quantite_stock }} unités
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        @php
                                            $percentage = min(100, ($produit->quantite_stock / ($produit->seuil_alerte * 3)) * 100);
                                            $color = $produit->quantite_stock <= $produit->seuil_alerte
                                                    ? ($produit->quantite_stock == 0 ? 'bg-red-500' : 'bg-yellow-500')
                                                    : 'bg-green-500';
                                        @endphp
                                        <div class="h-2 rounded-full {{ $color }}" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        Seuil: {{ $produit->seuil_alerte }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($produit->fournisseur)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8 bg-purple-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-industry text-purple-600 text-xs"></i>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900">{{ $produit->fournisseur->nom }}</div>
                                    </div>
                                </div>
                            @else
                                <span class="text-gray-400 text-sm">Aucun</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('produits.show', $produit) }}"
                                   class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('produits.edit', $produit) }}"
                                   class="text-yellow-600 hover:text-yellow-900 bg-yellow-50 hover:bg-yellow-100 p-2 rounded-lg transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('produits.destroy', $produit) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-gray-400">
                                <i class="fas fa-inbox text-4xl mb-4"></i>
                                <p class="text-xl font-semibold">Aucun produit trouvé</p>
                                <p class="mt-2">Commencez par ajouter votre premier produit</p>
                                <a href="{{ route('produits.create') }}"
                                   class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                                    <i class="fas fa-plus mr-2"></i> Ajouter un produit
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
            <div class="bg-white px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Affichage de {{ $produits->firstItem() }} à {{ $produits->lastItem() }} sur {{ $produits->total() }} résultats
                    </div>
                    <div class="flex space-x-2">
                        {{ $produits->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
