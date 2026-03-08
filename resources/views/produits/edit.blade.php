
@extends('layouts.master')

@section('title', 'Modifier le Produit')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- En-tête -->
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-6 py-4">
                <div class="flex items-center">
                    <a href="{{ route('produits.show', $produit) }}"
                       class="text-white hover:text-yellow-100 mr-4 transition">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-white">
                            <i class="fas fa-edit mr-2"></i> Modifier le Produit
                        </h1>
                        <p class="text-yellow-100 mt-1">Modifiez les informations du produit "{{ $produit->designation }}"</p>
                    </div>
                </div>
            </div>

            <!-- Formulaire -->
            <form action="{{ route('produits.update', $produit) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Informations de base -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i> Informations de base
                        </h3>

                        <div>
                            <label for="reference" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-hashtag mr-1 text-gray-400"></i> Référence *
                            </label>
                            <input type="text"
                                   id="reference"
                                   name="reference"
                                   value="{{ old('reference', $produit->reference) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   required>
                            @error('reference')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="designation" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-tag mr-1 text-gray-400"></i> Désignation *
                            </label>
                            <input type="text"
                                   id="designation"
                                   name="designation"
                                   value="{{ old('designation', $produit->designation) }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                   required>
                            @error('designation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-align-left mr-1 text-gray-400"></i> Description
                            </label>
                            <textarea id="description"
                                      name="description"
                                      rows="3"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('description', $produit->description) }}</textarea>
                            @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Prix et stock -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">
                            <i class="fas fa-chart-line mr-2 text-green-500"></i> Prix & Stock
                        </h3>

                        <div>
                            <label for="prix" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-money-bill-wave mr-1 text-gray-400"></i> Prix (MAD) *
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500">DH</span>
                                </div>
                                <input type="number"
                                       step="0.01"
                                       id="prix"
                                       name="prix"
                                       value="{{ old('prix', $produit->prix) }}"
                                       class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"
                                       required>
                            </div>
                            @error('prix')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
{{--                            <div>--}}
{{--                                <label for="quantite_stock" class="block text-sm font-medium text-gray-700 mb-1">--}}
{{--                                    <i class="fas fa-boxes mr-1 text-gray-400"></i> Quantité Stock *--}}
{{--                                </label>--}}
{{--                                <input type="number"--}}
{{--                                       id="quantite_stock"--}}
{{--                                       name="quantite_stock"--}}
{{--                                       value="{{ old('quantite_stock', $produit->quantite_stock) }}"--}}
{{--                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition"--}}
{{--                                       required>--}}
{{--                                @error('quantite_stock')--}}
{{--                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

                            <div>
                                <label for="seuil_alerte" class="block text-sm font-medium text-gray-700 mb-1">
                                    <i class="fas fa-exclamation-triangle mr-1 text-gray-400"></i> Seuil Alerte *
                                </label>
                                <input type="number"
                                       id="seuil_alerte"
                                       name="seuil_alerte"
                                       value="{{ old('seuil_alerte', $produit->seuil_alerte) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition"
                                       required>
                                @error('seuil_alerte')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="fournisseur_id" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-industry mr-1 text-gray-400"></i> Fournisseur
                            </label>
                            <select id="fournisseur_id"
                                    name="fournisseur_id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
                                <option value="">Sélectionnez un fournisseur</option>
                                @foreach($fournisseurs as $fournisseur)
                                    <option value="{{ $fournisseur->id }}" {{ old('fournisseur_id', $produit->fournisseur_id) == $fournisseur->id ? 'selected' : '' }}>
                                        {{ $fournisseur->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('fournisseur_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <div class="text-sm text-gray-500">
                        Dernière modification : {{ $produit->updated_at->format('d/m/Y à H:i') }}
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('produits.index') }}"
                           class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                            <i class="fas fa-times mr-2"></i> Annuler
                        </a>
                        <button type="submit"
                                class="px-6 py-2 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white rounded-lg hover:from-yellow-600 hover:to-yellow-700 transition transform hover:scale-105">
                            <i class="fas fa-save mr-2"></i> Mettre à jour
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Prévisualisation -->
        <div class="mt-6 bg-gray-50 border border-gray-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-eye mr-2 text-purple-500"></i> Aperçu des modifications
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-lg">
                    <p class="text-sm text-gray-500">Nouveau prix</p>
                    <p class="text-xl font-bold text-green-600" id="prix-preview">{{ number_format($produit->prix, 2) }} MAD</p>
                </div>
                <div class="bg-white p-4 rounded-lg">
                    <p class="text-sm text-gray-500">Nouveau stock</p>
                    <p class="text-xl font-bold text-blue-600" id="stock-preview">{{ $produit->quantite_stock }} unités</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Mise à jour en temps réel de l'aperçu
            document.getElementById('prix').addEventListener('input', function(e) {
                document.getElementById('prix-preview').textContent =
                    parseFloat(e.target.value).toFixed(2) + ' MAD';
            });

            document.getElementById('quantite_stock').addEventListener('input', function(e) {
                document.getElementById('stock-preview').textContent =
                    e.target.value + ' unités';
            });
        </script>
    @endpush
@endsection
