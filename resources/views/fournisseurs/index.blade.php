@extends('layouts.master')

@section('title', 'Gestion des Fournisseurs')

@section('content')
    <div class="px-4 py-5 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Gestion des Fournisseurs</h2>
                    <p class="mt-1 text-sm text-gray-600">Gérez vos fournisseurs et leurs informations</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('fournisseurs.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:border-primary-900 focus:ring focus:ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <i class="fas fa-plus mr-2"></i> Nouveau Fournisseur
                    </a>
                </div>
            </div>

            <!-- Stats -->
        </div>

        <!-- Search and Filters -->
        <div class="mb-6">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <!-- Search -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Rechercher</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text"
                                       id="search"
                                       placeholder="Nom, email, téléphone..."
                                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <!-- Fournisseurs Table -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fournisseur
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Produits
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Dernière mise à jour
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($fournisseurs as $fournisseur)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-primary-500 to-primary-600 flex items-center justify-center">
                                            <span class="text-white font-semibold">{{ strtoupper(substr($fournisseur->nom, 0, 1)) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <a href="{{ route('fournisseurs.show', $fournisseur) }}"
                                               class="hover:text-primary-600 transition-colors">
                                                {{ $fournisseur->nom }}
                                            </a>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            ID: {{ $fournisseur->id }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    @if($fournisseur->email)
                                        <div class="flex items-center mb-1">
                                            <i class="fas fa-envelope text-gray-400 mr-2 text-xs"></i>
                                            <span class="truncate max-w-xs">{{ $fournisseur->email }}</span>
                                            <button onclick="copyToClipboard('{{ $fournisseur->email }}', 'copy-email-{{ $fournisseur->id }}')"
                                                    id="copy-email-{{ $fournisseur->id }}"
                                                    class="ml-2 text-gray-400 hover:text-gray-600">
                                                <i class="fas fa-copy text-xs"></i>
                                            </button>
                                        </div>
                                    @endif
                                    @if($fournisseur->telephone)
                                        <div class="flex items-center">
                                            <i class="fas fa-phone text-gray-400 mr-2 text-xs"></i>
                                            <span>{{ $fournisseur->telephone }}</span>
                                            <button onclick="copyToClipboard('{{ $fournisseur->telephone }}', 'copy-phone-{{ $fournisseur->id }}')"
                                                    id="copy-phone-{{ $fournisseur->id }}"
                                                    class="ml-2 text-gray-400 hover:text-gray-600">
                                                <i class="fas fa-copy text-xs"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-box mr-1"></i>
                                    {{ $fournisseur->produits_count  }} produits
                                </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="far fa-clock text-gray-400 mr-2"></i>
                                    {{ $fournisseur->updated_at->diffForHumans() }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <!-- View -->
                                    <a href="{{ route('fournisseurs.show', $fournisseur) }}"
                                       class="text-primary-600 hover:text-primary-900 p-1 rounded hover:bg-primary-50"
                                       title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('fournisseurs.edit', $fournisseur) }}"
                                       class="text-yellow-600 hover:text-yellow-900 p-1 rounded hover:bg-yellow-50"
                                       title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- supprimer -->
                                    <form method="POST"
                                          action="{{ route('fournisseurs.destroy', $fournisseur) }}"
                                          onsubmit="return confirmDelete('Supprimer ce fournisseur ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50"
                                                role="menuitem">
                                            <i class="fas fa-trash mr-2"></i>
                                        </button>
                                    </form>


                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <i class="fas fa-truck fa-3x mb-4"></i>
                                    <p class="text-lg font-medium text-gray-600">Aucun fournisseur trouvé</p>
                                    <p class="mt-2 text-gray-500">Commencez par ajouter votre premier fournisseur.</p>
                                    <a href="{{ route('fournisseurs.create') }}"
                                       class="mt-4 inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">
                                        <i class="fas fa-plus mr-2"></i> Ajouter un fournisseur
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($fournisseurs->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 flex justify-between sm:hidden">
                            {{ $fournisseurs->links() }}
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Affichage de
                                    <span class="font-medium">{{ $fournisseurs->firstItem() }}</span>
                                    à
                                    <span class="font-medium">{{ $fournisseurs->lastItem() }}</span>
                                    sur
                                    <span class="font-medium">{{ $fournisseurs->total() }}</span>
                                    résultats
                                </p>
                            </div>
                            <div>
                                {{ $fournisseurs->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            // Toggle dropdown
            function toggleDropdown(id) {
                const dropdown = document.getElementById(`dropdown-${id}`);
                dropdown.classList.toggle('hidden');

                // Close other dropdowns
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    if (el.id !== `dropdown-${id}`) {
                        el.classList.add('hidden');
                    }
                });
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(event) {
                if (!event.target.matches('[id^="menu-button-"]')) {
                    document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                        el.classList.add('hidden');
                    });
                }
            });

            // Search functionality
            document.getElementById('search').addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        </script>
    @endpush
@endsection
