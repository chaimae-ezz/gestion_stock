@extends('layouts.master')

@section('title', 'Modifier le Produit')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    <i class="fas fa-edit text-blue-600 mr-2"></i> Modifier le Produit
                </h1>
                <p class="text-gray-600 mt-1">
                    Modifiez les informations du produit "{{ $produit->designation }}"
                </p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('produits.index') }}"
                   class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Retour
                </a>
            </div>
        </div>

        <!-- Formulaire sans rectangle blanc -->
        <form action="{{ route('produits.update', $produit) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Informations de base -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i> Informations de base
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Référence -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Référence <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="reference"
                               value="{{ old('reference', $produit->reference) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('reference')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">PRD-886</p>
                    </div>

                    <!-- Désignation -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Désignation <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="designation"
                               value="{{ old('designation', $produit->designation) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('designation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description (full width) -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea name="description" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $produit->description) }}</textarea>
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
                            Prix (MAD) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" step="0.01" name="prix"
                                   value="{{ old('prix', $produit->prix) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <span class="absolute right-3 top-2 text-gray-500">MAD</span>
                        </div>
                        @error('prix')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Seuil Alerte -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Seuil Alerte <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="seuil_alerte"
                               value="{{ old('seuil_alerte', $produit->seuil_alerte) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('seuil_alerte')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fournisseur -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Fournisseur
                        </label>
                        <select name="fournisseur_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Sélectionner un fournisseur</option>

                            @if(isset($fournisseurs) && $fournisseurs->count() > 0)
                                @foreach($fournisseurs as $fournisseur)
                                    <option value="{{ $fournisseur->id }}"
                                        {{ old('fournisseur_id', $produit->fournisseur_id) == $fournisseur->id ? 'selected' : '' }}>
                                        {{ $fournisseur->nom }}
                                    </option>
                                @endforeach
                            @else
                                <option value="" disabled class="text-gray-400">
                                    Aucun fournisseur disponible
                                </option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('produits.index') }}"
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Annuler
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition">
                    <i class="fas fa-save mr-2"></i> Mettre à jour
                </button>
            </div>
        </form>
    </div>
@endsection
