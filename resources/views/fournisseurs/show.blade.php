@extends('layouts.master')

@section('title', 'Détails Fournisseur')

@section('content')
    <div class="px-4 py-5 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="{{ route('fournisseurs.index') }}"
                       class="text-primary-600 hover:text-primary-900 mr-4">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Détails du fournisseur</h2>
                        <p class="mt-1 text-sm text-gray-600">Informations complètes et statistiques</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Informations -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Informations principales -->
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-16 w-16 rounded-full bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold">{{ strtoupper(substr($fournisseur->nom, 0, 1)) }}</span>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $fournisseur->nom }}</h3>
                                    <p class="text-sm text-gray-500">
                                        Fournisseur ID: <span class="font-mono">{{ $fournisseur->id }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-2"></i> Actif
                            </span>
                                <span class="text-sm text-gray-500">
                                Depuis {{ $fournisseur->created_at->diffForHumans() }}
                            </span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Contact Info -->
                            <div>
                                <h4 class="text-lg font-medium text-gray-900 mb-4">
                                    <i class="fas fa-address-card mr-2 text-primary-500"></i> Contact
                                </h4>
                                <div class="space-y-3">
                                    @if($fournisseur->email)
                                        <div class="flex items-start">
                                            <i class="fas fa-envelope text-gray-400 mt-1 mr-3"></i>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Email</p>
                                                <p class="text-sm text-gray-600">{{ $fournisseur->email }}</p>
                                            </div>
                                            <button onclick="copyToClipboard('{{ $fournisseur->email }}', 'copy-email')"
                                                    id="copy-email"
                                                    class="ml-auto text-gray-400 hover:text-gray-600">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    @endif

                                    @if($fournisseur->telephone)
                                        <div class="flex items-start">
                                            <i class="fas fa-phone text-gray-400 mt-1 mr-3"></i>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Téléphone</p>
                                                <p class="text-sm text-gray-600">{{ $fournisseur->telephone }}</p>
                                            </div>
                                            <button onclick="copyToClipboard('{{ $fournisseur->telephone }}', 'copy-phone')"
                                                    id="copy-phone"
                                                    class="ml-auto text-gray-400 hover:text-gray-600">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Adresse -->
                            <div>
                                <h4 class="text-lg font-medium text-gray-900 mb-4">
                                    <i class="fas fa-map-marker-alt mr-2 text-primary-500"></i> Adresse
                                </h4>
                                <div class="space-y-3">
                                    @if($fournisseur->adresse)
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Adresse</p>
                                            <p class="text-sm text-gray-600 whitespace-pre-line">{{ $fournisseur->adresse }}</p>
                                        </div>
                                    @endif

                                    @if($fournisseur->ville || $fournisseur->code_postal)
                                        <div class="flex items-center space-x-4">
                                            @if($fournisseur->ville)
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Ville</p>
                                                    <p class="text-sm text-gray-600">{{ $fournisseur->ville }}</p>
                                                </div>
                                            @endif

                                            @if($fournisseur->code_postal)
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Code postal</p>
                                                    <p class="text-sm text-gray-600">{{ $fournisseur->code_postal }}</p>
                                                </div>
                                            @endif

                                            @if($fournisseur->pays)
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Pays</p>
                                                    <p class="text-sm text-gray-600">{{ $fournisseur->pays }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="border-t border-gray-200 px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <div>
                                <i class="far fa-calendar-plus mr-1"></i>
                                Créé le {{ $fournisseur->created_at->format('d/m/Y à H:i') }}
                            </div>
                            <div>
                                <i class="far fa-calendar-check mr-1"></i>
                                Dernière modification {{ $fournisseur->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Produits du fournisseur -->
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900">
                                <i class="fas fa-boxes mr-2 text-primary-500"></i> Produits fournis
                            </h3>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                            {{ $fournisseur->produits_count ?? 0 }} produits
                        </span>
                        </div>
                    </div>

                    <div class="px-4 py-5 sm:p-6">
                        @if($fournisseur->produits && $fournisseur->produits->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                    <tr>
                                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
                                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                        <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                    @foreach($fournisseur->produits->take(5) as $produit)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-3 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $produit->designation }}</div>
                                                <div class="text-sm text-gray-500">{{ $produit->reference }}</div>
                                            </td>
                                            <td class="px-3 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $produit->quantite_stock }}</div>
                                            </td>
                                            <td class="px-3 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ number_format($produit->prix_achat, 2) }} €</div>
                                            </td>
                                            <td class="px-3 py-4 whitespace-nowrap">
                                                @if($produit->quantite_stock <= 0)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rupture</span>
                                                @elseif($produit->quantite_stock <= $produit->seuil_alerte)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Alerte</span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">OK</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if($fournisseur->produits->count() > 5)
                                <div class="mt-4 text-center">
                                    <a href="#" class="text-primary-600 hover:text-primary-900 text-sm font-medium">
                                        Voir tous les produits ({{ $fournisseur->produits->count() }})
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-8">
                                <i class="fas fa-box-open text-gray-300 text-4xl mb-3"></i>
                                <p class="text-gray-500">Aucun produit associé à ce fournisseur</p>

                                <a href="{{ route('produits.create' ,['fournisseur_id' => $fournisseur->id])}}" class="mt-2 inline-flex items-center text-primary-600 hover:text-primary-900">
                                    <i class="fas fa-plus mr-1"></i> Ajouter un produit
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column - Statistiques et Actions -->
            <div class="space-y-8">
                <!-- Statistiques -->
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">
                            <i class="fas fa-chart-bar mr-2 text-primary-500"></i> Statistiques
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Produits actifs</p>
                                <p class="text-2xl font-semibold text-gray-900"> {{ $fournisseur->produits->count() }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Valeur totale du stock</p>
                                <p class="text-2xl font-semibold text-gray-900">
                                    {{ number_format($fournisseur->produits->sum('quantite_stock'), 2) }} DH
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Actions rapides -->
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">
                            <i class="fas fa-bolt mr-2 text-primary-500"></i> Actions rapides
                        </h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="space-y-3">

                            <a href="{{ route('fournisseurs.edit', $fournisseur) }}"
                               class="w-full flex items-center justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                                <i class="fas fa-edit mr-2"></i> Modifier
                            </a>

                            <form action="{{ route('fournisseurs.destroy', $fournisseur) }}"
                                  method="POST"
                                  onsubmit="return confirmDelete('Supprimer définitivement ce fournisseur ?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="w-full flex items-center justify-center px-4 py-2 border border-red-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50">
                                    <i class="fas fa-trash mr-2"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Format phone number
            document.addEventListener('DOMContentLoaded', function() {
                const phoneElements = document.querySelectorAll('[id^="copy-phone"]');
                phoneElements.forEach(el => {
                    const phone = el.getAttribute('onclick').match(/'([^']+)'/)[1];
                    if (phone) {
                        const formatted = phone.replace(/(\d{2})(?=\d)/g, '$1 ');
                        el.previousElementSibling.querySelector('p:last-child').textContent = formatted;
                    }
                });
            });
        </script>
    @endpush
@endsection
