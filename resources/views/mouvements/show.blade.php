@extends('layouts.master')

@section('title', 'Détail du Mouvement - StockMaster')

@section('content')
    <div class="px-4 py-6 sm:px-6 lg:px-8">
        <!-- En-tête -->
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <div class="flex items-center">
                    <div class="h-10 w-10 rounded-lg bg-primary-600 flex items-center justify-center mr-4">
                        <i class="fas fa-eye text-white"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-3">
                            <h1 class="text-2xl font-bold text-gray-900">Détail du Mouvement</h1>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            #{{ str_pad($mouvement->id, 6, '0', STR_PAD_LEFT) }}
                        </span>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Consultez les informations détaillées de ce mouvement</p>
                    </div>
                </div>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-3">
                <a href="{{ route('mouvements.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-400 focus:outline-none focus:border-gray-500 focus:ring ring-gray-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour
                </a>
                <button onclick="window.print()"
                        class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring ring-primary-300">
                    <i class="fas fa-print mr-2"></i>
                    Imprimer
                </button>
            </div>
        </div>

        <!-- Cartes d'information -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Carte Date -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <i class="fas fa-calendar-alt text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Date & Heure</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ $mouvement->date_mouvement->format('d/m/Y') }}</dd>
                                <dd class="text-sm text-gray-500">{{ $mouvement->date_mouvement->format('H:i:s') }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte Type -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        @php
                            $typeConfig = [
                                'entree' => ['bg-green-500', 'fa-arrow-down', 'text-green-600'],
                                'sortie' => ['bg-red-500', 'fa-arrow-up', 'text-red-600'],
                                'ajustement' => ['bg-yellow-500', 'fa-adjust', 'text-yellow-600'],
                                'inventaire' => ['bg-blue-500', 'fa-clipboard-list', 'text-blue-600']
                            ];
                            [$bgColor, $icon, $textColor] = $typeConfig[$mouvement->type_mouvement] ?? ['bg-gray-500', 'fa-exchange-alt', 'text-gray-600'];
                        @endphp
                        <div class="flex-shrink-0 {{ $bgColor }} rounded-md p-3">
                            <i class="fas {{ $icon }} text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Type de mouvement</dt>
                                <dd class="text-lg font-semibold {{ $textColor }}">{{ ucfirst($mouvement->type_mouvement) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte Statut -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Statut</dt>
                                <dd class="text-lg font-semibold text-gray-900">Validé</dd>
                                <dd class="text-sm text-gray-500">{{ $mouvement->created_at->diffForHumans() }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carte Référence -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                            <i class="fas fa-barcode text-white text-xl"></i>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Référence</dt>
                                <dd class="text-lg font-semibold text-gray-900 font-mono">MVT-{{ str_pad($mouvement->id, 6, '0', STR_PAD_LEFT) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grille principale -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Colonne de gauche (2/3) -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Carte Produit -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class="fas fa-box text-primary-600 mr-3"></i>
                            Produit concerné
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 h-16 w-16 rounded-lg bg-primary-100 flex items-center justify-center">
                                <i class="fas fa-cube text-primary-600 text-3xl"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-900">{{ $mouvement->produit->designation }}</h4>
                                        <p class="text-sm text-gray-500">Référence: <span class="font-mono">{{ $mouvement->produit->reference }}</span></p>
                                    </div>
                                    <a href="{{ route('produits.show', $mouvement->produit) }}"
                                       class="text-primary-600 hover:text-primary-900 text-sm font-medium">
                                        Voir le produit <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>

                                <div class="mt-4 grid grid-cols-2 gap-4">
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500">Stock actuel</p>
                                        <p class="text-xl font-bold text-primary-600">{{ $mouvement->produit->quantite_stock }} unités</p>
                                    </div>
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500">Prix unitaire</p>
                                        <p class="text-xl font-bold text-gray-900">{{ number_format($mouvement->produit->prix_achat, 2) }} €</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carte Évolution du Stock -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class="fas fa-chart-line text-primary-600 mr-3"></i>
                            Évolution du stock
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center justify-between">
                            <!-- Avant -->
                            <div class="text-center flex-1">
                                <div class="text-sm text-gray-500 mb-2">Avant mouvement</div>
                                <div class="text-3xl font-bold text-gray-700">{{ $mouvement->quantite_avant }}</div>
                                <div class="text-xs text-gray-400 mt-1">unités</div>
                            </div>

                            <!-- Flèche -->
                            <div class="flex-shrink-0 px-8">
                                <i class="fas fa-long-arrow-alt-right text-3xl text-gray-400"></i>
                            </div>

                            <!-- Mouvement -->
                            <div class="text-center flex-1">
                                <div class="text-sm text-gray-500 mb-2">Mouvement</div>
                                <div class="text-3xl font-bold {{ $mouvement->type_mouvement == 'entree' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $mouvement->type_mouvement == 'entree' ? '+' : '-' }}{{ $mouvement->quantite }}
                                </div>
                                <div class="text-xs text-gray-400 mt-1">unités</div>
                            </div>

                            <!-- Flèche -->
                            <div class="flex-shrink-0 px-8">
                                <i class="fas fa-long-arrow-alt-right text-3xl text-gray-400"></i>
                            </div>

                            <!-- Après -->
                            <div class="text-center flex-1">
                                <div class="text-sm text-gray-500 mb-2">Après mouvement</div>
                                <div class="text-3xl font-bold text-primary-600">{{ $mouvement->quantite_apres }}</div>
                                <div class="text-xs text-gray-400 mt-1">unités</div>
                            </div>
                        </div>

                        <!-- Variation -->
                        <div class="mt-6 p-4 {{ $mouvement->type_mouvement == 'entree' ? 'bg-green-50' : 'bg-red-50' }} rounded-lg text-center">
                            <p class="text-sm font-medium {{ $mouvement->type_mouvement == 'entree' ? 'text-green-800' : 'text-red-800' }}">
                                <i class="fas {{ $mouvement->type_mouvement == 'entree' ? 'fa-arrow-down' : 'fa-arrow-up' }} mr-2"></i>
                                {{ $mouvement->type_mouvement == 'entree' ? 'Augmentation' : 'Diminution' }} du stock
                                <strong class="mx-1">{{ $mouvement->quantite }}</strong> unités
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Détails complémentaires -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class="fas fa-file-alt text-primary-600 mr-3"></i>
                            Détails complémentaires
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500 mb-1">Motif</p>
                                <div class="p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-900">{{ $mouvement->motif ?? 'Non spécifié' }}</p>
                                </div>
                            </div>

                            @if($mouvement->notes)
                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Notes additionnelles</p>
                                    <div class="p-3 bg-gray-50 rounded-lg">
                                        <p class="text-gray-900">{{ $mouvement->notes }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Colonne de droite (1/3) -->
            <div class="space-y-8">
                <!-- Carte Utilisateur -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class="fas fa-user-circle text-primary-600 mr-3"></i>
                            Opérateur
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="h-16 w-16 rounded-full bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center text-white text-2xl font-bold">
                                    {{ strtoupper(substr($mouvement->user->name ?? 'S', 0, 1)) }}
                                </div>
                            </div>
                            <div>
                                <p class="text-lg font-semibold text-gray-900">{{ $mouvement->user->name ?? 'Système' }}</p>
                                <p class="text-sm text-gray-500">{{ $mouvement->user->email ?? '' }}</p>
                                <p class="text-xs text-gray-400 mt-1">Opérateur</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class="fas fa-bolt text-primary-600 mr-3"></i>
                            Actions rapides
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="space-y-3">
                            <a href="{{ route('mouvements.create') }}"
                               class="w-full inline-flex items-center justify-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700">
                                <i class="fas fa-plus-circle mr-2"></i>
                                Nouveau mouvement
                            </a>

                            <a href="{{ route('produits.show', $mouvement->produit) }}"
                               class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                                <i class="fas fa-box mr-2"></i>
                                Voir le produit
                            </a>

                            <a href="{{ route('mouvements.index', ['produit' => $mouvement->produit_id]) }}"
                               class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                                <i class="fas fa-history mr-2"></i>
                                Historique du produit
                            </a>

                            <button onclick="copyToClipboard('MVT-{{ str_pad($mouvement->id, 6, '0', STR_PAD_LEFT) }}', 'copy-btn')"
                                    id="copy-btn"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                                <i class="fas fa-copy mr-2"></i>
                                Copier la référence
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Métadonnées -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <i class="fas fa-clock text-primary-600 mr-3"></i>
                            Informations système
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Créé le</span>
                                <span class="text-gray-900">{{ $mouvement->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Dernière modif.</span>
                                <span class="text-gray-900">{{ $mouvement->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">ID mouvement</span>
                                <span class="text-gray-900 font-mono">#{{ $mouvement->id }}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function copyToClipboard(text, elementId) {
            navigator.clipboard.writeText(text).then(() => {
                const btn = document.getElementById(elementId);
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-check mr-2"></i> Copié !';
                btn.classList.remove('bg-gray-200', 'hover:bg-gray-300');
                btn.classList.add('bg-green-500', 'text-white');

                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                    btn.classList.remove('bg-green-500', 'text-white');
                    btn.classList.add('bg-gray-200', 'hover:bg-gray-300');
                }, 2000);
            }).catch(err => {
                alert('Erreur lors de la copie');
            });
        }
    </script>
@endpush

@push('styles')
    <style>
        @media print {
            nav, footer, button, .actions {
                display: none !important;
            }
            body {
                background: white;
            }
            .shadow {
                box-shadow: none !important;
                border: 1px solid #ddd;
            }
        }
    </style>
@endpush
