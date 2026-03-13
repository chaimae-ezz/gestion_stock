@extends('layouts.master')

@section('title', 'Détails du Produit')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    <i class="fas fa-eye text-blue-600 mr-2"></i> Détails du Produit
                </h1>
                <p class="text-gray-600 mt-1">
                    Consultation du produit "{{ $produit->designation }}"
                </p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('produits.index') }}"
                   class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Retour
                </a>
            </div>
        </div>

        <!-- Formulaire en lecture seule -->
        <div class="mb-8">
            <!-- Informations de base -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i> Informations de base
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Référence -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Référence
                        </label>
                        <div class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-700">
                            {{ $produit->reference }}
                        </div>
                    </div>

                    <!-- Désignation -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Désignation
                        </label>
                        <div class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-700">
                            {{ $produit->designation }}
                        </div>
                    </div>

                    <!-- Description (full width) -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <div class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-700 min-h-[80px]">
                            {{ $produit->description ?: 'Aucune description' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Prix & Stock -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-line text-green-500 mr-2"></i> Prix & Stock
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Prix -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Prix (MAD)
                        </label>
                        <div class="relative">
                            <div class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-700">
                                {{ number_format($produit->prix, 2) }} MAD
                            </div>
                        </div>
                    </div>

                    <!-- Seuil Alerte -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Seuil Alerte
                        </label>
                        <div class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-700">
                            {{ $produit->seuil_alerte }}
                        </div>
                    </div>

                    <!-- Fournisseur -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Fournisseur
                        </label>
                        <div class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-700">
                            @if($produit->fournisseur)
                                {{ $produit->fournisseur->nom }}
                            @else
                                <span class="text-gray-400">Aucun fournisseur</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('produits.index') }}"
                   class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>
@endsection
