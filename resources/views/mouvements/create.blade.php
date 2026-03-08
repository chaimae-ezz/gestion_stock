@extends('layouts.master')

@section('title', 'Nouveau Mouvement - StockMaster')

@section('content')
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-lg bg-primary-600 flex items-center justify-center mr-4">
                        <i class="fas fa-plus-circle text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Nouveau Mouvement de Stock</h1>
                        <p class="mt-1 text-sm text-gray-500">Enregistrez une entrée, sortie ou ajustement de stock</p>
                    </div>
                </div>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('mouvements.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour
                </a>
            </div>
        </div>

        <!-- Formulaire -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('mouvements.store') }}" method="POST">
                    @csrf

                    <!-- Grille 2 colonnes -->
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <!-- Produit -->
                        <div>
                            <label for="produit_id" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-box text-primary-600 mr-2"></i>
                                Produit <span class="text-red-500">*</span>
                            </label>
                            <select name="produit_id"
                                    id="produit_id"
                                    class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    required>
                                <option value="">Sélectionnez un produit</option>
                                @foreach($produits as $produit)
                                    <option value="{{ $produit->id }}"
                                            data-stock="{{ $produit->quantite_stock }}"
                                            data-seuil="{{ $produit->seuil_alerte }}"
                                        {{ old('produit_id', request('produit_id')) == $produit->id ? 'selected' : '' }}>
                                        {{ $produit->designation }} (Réf: {{ $produit->reference }}) - Stock: {{ $produit->quantite_stock }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Info stock -->
                            <div id="stock-info" class="mt-2 text-sm text-gray-500 flex items-start">
                                <i class="fas fa-info-circle text-primary-500 mr-1 mt-0.5"></i>
                                <span>Sélectionnez un produit pour voir le stock actuel</span>
                            </div>

                            @error('produit_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type de mouvement -->
                        <div>
                            <label for="type_mouvement" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-exchange-alt text-primary-600 mr-2"></i>
                                Type de mouvement <span class="text-red-500">*</span>
                            </label>
                            <select name="type_mouvement"
                                    id="type_mouvement"
                                    class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    required>
                                <option value="">Sélectionnez un type</option>
                                <option value="entree" {{ old('type_mouvement') == 'entree' ? 'selected' : '' }}>Entrée de stock</option>
                                <option value="sortie" {{ old('type_mouvement') == 'sortie' ? 'selected' : '' }}>Sortie de stock</option>
                                <option value="ajustement" {{ old('type_mouvement') == 'ajustement' ? 'selected' : '' }}>Ajustement</option>
                                <option value="inventaire" {{ old('type_mouvement') == 'inventaire' ? 'selected' : '' }}>Inventaire</option>
                            </select>

                            <!-- Aide selon le type -->
                            <p id="type-help" class="mt-2 text-xs text-gray-500">
                                <i class="fas fa-lightbulb text-yellow-500 mr-1"></i>
                                Sélectionnez un type pour plus d'informations
                            </p>

                            @error('type_mouvement')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Quantité -->
                        <div>
                            <label for="quantite" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-balance-scale text-primary-600 mr-2"></i>
                                Quantité <span class="text-red-500">*</span>
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <input type="number"
                                       name="quantite"
                                       id="quantite"
                                       value="{{ old('quantite') }}"
                                       min="1"
                                       step="1"
                                       class="focus:ring-primary-500 focus:border-primary-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md transition-colors"
                                       placeholder="0"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm" id="quantite-unite">unités</span>
                                </div>
                            </div>

                            <!-- Message stock max -->
                            <p id="quantite-help" class="mt-2 text-xs text-gray-500 hidden">
                                <i class="fas fa-info-circle mr-1"></i>
                                <span></span>
                            </p>

                            @error('quantite')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Motif -->
                        <div>
                            <label for="motif" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-comment text-primary-600 mr-2"></i>
                                Motif
                            </label>
                            <input type="text"
                                   name="motif"
                                   id="motif"
                                   value="{{ old('motif') }}"
                                   class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                   placeholder="Ex: Commande n°123, Retour client...">
                            @error('motif')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mt-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-sticky-note text-primary-600 mr-2"></i>
                            Notes (optionnel)
                        </label>
                        <textarea name="notes"
                                  id="notes"
                                  rows="3"
                                  class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                  placeholder="Informations complémentaires...">{{ old('notes') }}</textarea>
                        @error('notes')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Aperçu du mouvement -->
                    <div id="preview" class="mt-8 p-4 bg-gray-50 rounded-lg border border-gray-200 hidden">
                        <h3 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-eye text-primary-600 mr-2"></i>
                            Aperçu du mouvement
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <p class="text-xs text-gray-500">Stock avant</p>
                                <p id="preview-avant" class="text-lg font-semibold text-gray-900">-</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Mouvement</p>
                                <p id="preview-mouvement" class="text-lg font-semibold">-</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Stock après</p>
                                <p id="preview-apres" class="text-lg font-semibold text-primary-600">-</p>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end space-x-3">
                        <a href="{{ route('mouvements.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300">
                            <i class="fas fa-times mr-2"></i>
                            Annuler
                        </a>
                        <button type="submit"
                                id="submit-btn"
                                class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring ring-primary-300 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-save mr-2"></i>
                            Enregistrer le mouvement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const produitSelect = document.getElementById('produit_id');
            const typeSelect = document.getElementById('type_mouvement');
            const quantiteInput = document.getElementById('quantite');
            const stockInfo = document.getElementById('stock-info');
            const typeHelp = document.getElementById('type-help');
            const quantiteHelp = document.getElementById('quantite-help');
            const preview = document.getElementById('preview');
            const previewAvant = document.getElementById('preview-avant');
            const previewMouvement = document.getElementById('preview-mouvement');
            const previewApres = document.getElementById('preview-apres');
            const submitBtn = document.getElementById('submit-btn');

            // Gestion des types de mouvement
            const typeDescriptions = {
                'entree': 'Ajout de stock - La quantité sera ajoutée au stock actuel',
                'sortie': 'Retrait de stock - La quantité sera soustraite du stock actuel',
                'ajustement': 'Correction de stock - Remplace le stock actuel par la nouvelle quantité',
                'inventaire': 'Mise à jour suite à inventaire - Remplace le stock actuel'
            };

            const typeColors = {
                'entree': 'text-green-600',
                'sortie': 'text-red-600',
                'ajustement': 'text-yellow-600',
                'inventaire': 'text-blue-600'
            };

            // Mettre à jour les infos de stock
            produitSelect.addEventListener('change', updateStockInfo);
            typeSelect.addEventListener('change', updateTypeInfo);
            quantiteInput.addEventListener('input', updatePreview);

            function updateStockInfo() {
                const selectedOption = produitSelect.options[produitSelect.selectedIndex];
                const stock = selectedOption?.getAttribute('data-stock');
                const seuil = selectedOption?.getAttribute('data-seuil');

                if (stock) {
                    let infoText = `<i class="fas fa-info-circle text-primary-500 mr-1 mt-0.5"></i>`;
                    infoText += `<span>Stock actuel: <strong class="text-gray-900">${stock}</strong> unités`;

                    if (seuil) {
                        infoText += ` | Seuil minimum: <strong class="text-gray-900">${seuil}</strong>`;
                        if (parseInt(stock) <= parseInt(seuil)) {
                            infoText += ` <span class="text-red-600"><i class="fas fa-exclamation-triangle"></i> Stock bas</span>`;
                        }
                    }
                    infoText += `</span>`;

                    stockInfo.innerHTML = infoText;

                    // Mettre à jour l'aide de quantité
                    const type = typeSelect.value;
                    if (type === 'sortie') {
                        quantiteHelp.classList.remove('hidden');
                        quantiteHelp.querySelector('span').textContent = `Stock maximum disponible: ${stock} unités`;
                        quantiteInput.max = stock;
                    } else {
                        quantiteHelp.classList.add('hidden');
                        quantiteInput.removeAttribute('max');
                    }

                    updatePreview();
                } else {
                    stockInfo.innerHTML = `<i class="fas fa-info-circle text-primary-500 mr-1 mt-0.5"></i>
                                   <span>Sélectionnez un produit pour voir le stock actuel</span>`;
                    quantiteHelp.classList.add('hidden');
                }
            }

            function updateTypeInfo() {
                const type = typeSelect.value;

                if (type) {
                    typeHelp.innerHTML = `<i class="fas fa-lightbulb text-yellow-500 mr-1"></i>
                                 <span>${typeDescriptions[type] || ''}</span>`;

                    // Style de la quantité selon le type
                    quantiteInput.classList.remove('border-green-500', 'border-red-500', 'border-yellow-500', 'border-blue-500');
                    if (type === 'entree') {
                        quantiteInput.classList.add('border-green-500');
                    } else if (type === 'sortie') {
                        quantiteInput.classList.add('border-red-500');
                    } else if (type === 'ajustement') {
                        quantiteInput.classList.add('border-yellow-500');
                    } else if (type === 'inventaire') {
                        quantiteInput.classList.add('border-blue-500');
                    }

                    // Mettre à jour l'aide de quantité selon le type
                    updateStockInfo();
                    updatePreview();
                } else {
                    typeHelp.innerHTML = `<i class="fas fa-lightbulb text-yellow-500 mr-1"></i>
                                 <span>Sélectionnez un type pour plus d'informations</span>`;
                    quantiteInput.classList.remove('border-green-500', 'border-red-500', 'border-yellow-500', 'border-blue-500');
                }
            }

            function updatePreview() {
                const produit = produitSelect.options[produitSelect.selectedIndex];
                const type = typeSelect.value;
                const quantite = parseInt(quantiteInput.value) || 0;
                const stockActuel = parseInt(produit?.getAttribute('data-stock')) || 0;

                if (produit && type && quantite > 0) {
                    let stockApres = stockActuel;
                    let mouvementText = '';
                    let mouvementClass = '';

                    switch(type) {
                        case 'entree':
                            stockApres = stockActuel + quantite;
                            mouvementText = `+${quantite}`;
                            mouvementClass = 'text-green-600';
                            submitBtn.disabled = false;
                            break;
                        case 'sortie':
                            if (quantite <= stockActuel) {
                                stockApres = stockActuel - quantite;
                                mouvementText = `-${quantite}`;
                                mouvementClass = 'text-red-600';
                                submitBtn.disabled = false;
                            } else {
                                mouvementText = 'Stock insuffisant';
                                mouvementClass = 'text-red-600';
                                submitBtn.disabled = true;
                            }
                            break;
                        case 'ajustement':
                        case 'inventaire':
                            stockApres = quantite;
                            mouvementText = `→ ${quantite}`;
                            mouvementClass = typeColors[type] || 'text-yellow-600';
                            submitBtn.disabled = false;
                            break;
                    }

                    previewAvant.textContent = stockActuel;
                    previewMouvement.textContent = mouvementText;
                    previewMouvement.className = `text-lg font-semibold ${mouvementClass}`;
                    previewApres.textContent = stockApres;
                    preview.classList.remove('hidden');

                    // Vérifier la validité
                    if (type === 'sortie' && quantite > stockActuel) {
                        submitBtn.disabled = true;
                    } else {
                        submitBtn.disabled = false;
                    }
                } else {
                    preview.classList.add('hidden');
                }
            }

            // Validation avant soumission
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const produitId = produitSelect.value;
                const type = typeSelect.value;
                const quantite = parseInt(quantiteInput.value);
                const stock = parseInt(produitSelect.options[produitSelect.selectedIndex]?.getAttribute('data-stock')) || 0;

                if (!produitId || !type || !quantite) {
                    e.preventDefault();
                    alert('Veuillez remplir tous les champs obligatoires.');
                    return;
                }

                if (type === 'sortie' && quantite > stock) {
                    e.preventDefault();
                    alert(`⚠️ Stock insuffisant!\nStock disponible: ${stock} unités\nQuantité demandée: ${quantite} unités`);
                    quantiteInput.focus();
                }
            });

            // Initialisation
            if (produitSelect.value) {
                updateStockInfo();
                // Déclencher aussi la mise à jour de l'aperçu si une quantité est déjà présente
                if (quantiteInput.value) {
                    updatePreview();
                }
            }
            if (typeSelect.value) updateTypeInfo();
        });
    </script>
@endpush

@push('styles')
    <style>
        /* Style pour les champs de formulaire */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            opacity: 1;
            height: 24px;
        }

        /* Animation pour les messages d'alerte */
        .text-red-600 {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
