@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen flex bg-gray-100">

        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg flex flex-col justify-between">

            <!-- Profile Section - Clickable -->
            <div>
                <a href="{{ route('profile.edit') }}" class="block p-6 border-b hover:bg-gray-50 transition group">
                    <div class="flex items-center space-x-4">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 flex items-center justify-center text-white font-bold text-lg shadow-lg group-hover:shadow-xl transition-all">
                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-semibold text-gray-800 group-hover:text-orange-600 transition">{{ Auth::user()->name }}</h3>
                                    <p class="text-sm text-gray-500 capitalize flex items-center">
                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                        {{ Auth::user()->role }}
                                    </p>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400 group-hover:text-orange-500 text-xs transition"></i>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Navigation -->
                <nav class="p-4 space-y-2">

                    <a href="{{ route('produits.index') }}"
                       class="flex items-center px-4 py-2 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition group">
                        <i class="fas fa-box mr-3 text-gray-500 group-hover:text-orange-500"></i>
                        <span>Gestion des Produits</span>
                    </a>

                    <a href="{{ route('fournisseurs.index') }}"
                       class="flex items-center px-4 py-2 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition group">
                        <i class="fas fa-truck mr-3 text-gray-500 group-hover:text-orange-500"></i>
                        <span>Gestion des Fournisseurs</span>
                    </a>

                    <a href="{{ route('mouvements.index') }}"
                       class="flex items-center px-4 py-2 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition group">
                        <i class="fas fa-exchange-alt mr-3 text-gray-500 group-hover:text-orange-500"></i>
                        <span>Mouvements de Stock</span>
                    </a>

                    <a href="{{ route('statistique') }}"
                       class="flex items-center px-4 py-2 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition group">
                        <i class="fas fa-chart-line mr-3 text-gray-500 group-hover:text-orange-500"></i>
                        <span>Statistiques</span>
                    </a>

                    {{-- Admin Only --}}
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('users.index') }}"
                           class="flex items-center px-4 py-2 rounded-lg bg-orange-100 text-orange-700 font-semibold group">
                            <i class="fas fa-users mr-3 text-orange-600"></i>
                            <span>Gestion des Utilisateurs</span>
                        </a>
                    @endif

                    <!-- Quick Profile Link (Mobile Friendly) -->
                    <a href="{{ route('profile.edit') }}"
                       class="lg:hidden flex items-center px-4 py-2 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition group mt-4 pt-4 border-t border-gray-100">
                        <i class="fas fa-user-cog mr-3 text-gray-500 group-hover:text-orange-500"></i>
                        <span>Mon Profil</span>
                        <span class="ml-auto text-xs bg-orange-100 text-orange-600 px-2 py-1 rounded-full">Modifier</span>
                    </a>

                </nav>
            </div>

            <!-- Logout -->
            <div class="p-4 border-t">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center justify-center px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition group">
                        <i class="fas fa-sign-out-alt mr-2 group-hover:translate-x-1 transition-transform"></i>
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10 overflow-y-auto">
            <!-- Header avec date et profil rapide -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        Bonjour, {{ Auth::user()->name }}
                    </h1>
                    <p class="text-gray-500 mt-1">
                        <i class="far fa-calendar-alt mr-2"></i>{{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                    </p>
                </div>

                <!-- Quick Profile Link (Desktop) -->
                <a href="{{ route('profile.edit') }}"
                   class="hidden lg:flex items-center space-x-3 px-4 py-2 bg-white rounded-xl shadow-sm hover:shadow-md transition border border-gray-100 group">
                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                    </div>
                    <div class="text-left">
                        <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 flex items-center">
                            <i class="fas fa-cog mr-1 group-hover:rotate-90 transition-transform"></i>
                            Modifier le profil
                        </p>
                    </div>
                </a>
            </div>

            <!-- Stats Cards (optionnelles) -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            @php
                                $Produits = \App\Models\Produit::count();
                            @endphp
                            <p class="text-xs text-gray-500 uppercase">Total Produits</p>
                            <p class="text-xl font-bold text-gray-800">{{$Produits}}</p>
                        </div>
                        <div class="h-10 w-10 rounded-lg bg-orange-50 flex items-center justify-center">
                            <i class="fas fa-box text-orange-500"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            @php
                                $fournisseurs = \App\Models\fournisseur::count();
                            @endphp
                            <p class="text-xs text-gray-500 uppercase">Fournisseurs</p>
                            <p class="text-xl font-bold text-gray-800">{{ $fournisseurs }}</p>
                        </div>
                        <div class="h-10 w-10 rounded-lg bg-blue-50 flex items-center justify-center">
                            <i class="fas fa-truck text-blue-500"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            @php
                                $Mouvements = \App\Models\MouvementStock::count();
                            @endphp
                            <p class="text-xs text-gray-500 uppercase">Mouvements</p>
                            <p class="text-xl font-bold text-gray-800">{{$Mouvements}}</p>
                        </div>
                        <div class="h-10 w-10 rounded-lg bg-green-50 flex items-center justify-center">
                            <i class="fas fa-exchange-alt text-green-500"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('produits.alertes') }}" class="block hover:bg-red-50 p-3 rounded-lg transition-colors">
                         <div>
                            @php
                                $alertes = \App\Models\Produit::whereColumn('quantite_stock', '<=', 'seuil_alerte')->count();
                            @endphp
                            <p class="text-xs text-gray-500 uppercase">Alertes</p>
                            <p class="text-xl font-bold text-red-500">{{ $alertes }}</p>
                         </div>
                        </a>
                        <div class="h-10 w-10 rounded-lg bg-red-50 flex items-center justify-center">
                            <i class="fas fa-bell text-red-500"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Produits -->
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border border-gray-100 group">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-700">Produits</h2>
                            <p class="text-sm text-gray-500">Gérer les articles en stock</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-orange-50 flex items-center justify-center group-hover:bg-orange-100 transition">
                            <i class="fas fa-box text-orange-500 text-xl"></i>
                        </div>
                    </div>
                    <a href="{{ route('produits.index') }}"
                       class="inline-flex items-center text-orange-600 font-medium hover:text-orange-700">
                        Accéder <i class="fas fa-arrow-right ml-2 text-sm group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Fournisseurs -->
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border border-gray-100 group">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-700">Fournisseurs</h2>
                            <p class="text-sm text-gray-500">Gérer les partenaires</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition">
                            <i class="fas fa-truck text-blue-500 text-xl"></i>
                        </div>
                    </div>
                    <a href="{{ route('fournisseurs.index') }}"
                       class="inline-flex items-center text-blue-600 font-medium hover:text-blue-700">
                        Accéder <i class="fas fa-arrow-right ml-2 text-sm group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Mouvements -->
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border border-gray-100 group">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-700">Mouvements</h2>
                            <p class="text-sm text-gray-500">Entrées & Sorties</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-green-50 flex items-center justify-center group-hover:bg-green-100 transition">
                            <i class="fas fa-exchange-alt text-green-500 text-xl"></i>
                        </div>
                    </div>
                    <a href="{{ route('mouvements.index') }}"
                       class="inline-flex items-center text-green-600 font-medium hover:text-green-700">
                        Accéder <i class="fas fa-arrow-right ml-2 text-sm group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                <!-- Statistiques -->
                <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border border-gray-100 group">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-700">Statistiques</h2>
                            <p class="text-sm text-gray-500">Analyse des données</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-purple-50 flex items-center justify-center group-hover:bg-purple-100 transition">
                            <i class="fas fa-chart-line text-purple-500 text-xl"></i>
                        </div>
                    </div>
                    <a href="{{ route('statistique') }}"
                       class="inline-flex items-center text-purple-600 font-medium hover:text-purple-700">
                        Accéder <i class="fas fa-arrow-right ml-2 text-sm group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

                {{-- Admin Only Card --}}
                @if(Auth::user()->role === 'admin')
                    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-2 border-orange-200 group">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-700">Utilisateurs</h2>
                                <p class="text-sm text-gray-500">Gestion des comptes</p>
                            </div>
                            <div class="h-12 w-12 rounded-xl bg-orange-50 flex items-center justify-center group-hover:bg-orange-100 transition">
                                <i class="fas fa-users text-orange-500 text-xl"></i>
                            </div>
                        </div>
                        <a href="{{ route('users.index') }}"
                           class="inline-flex items-center text-orange-600 font-medium hover:text-orange-700">
                            Accéder <i class="fas fa-arrow-right ml-2 text-sm group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                @endif

                <!-- Quick Profile Card -->
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition border border-orange-400 group cursor-pointer" onclick="window.location='{{ route('profile.edit') }}'">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-lg font-semibold text-white">Mon Profil</h2>
                            <p class="text-sm text-orange-100">Modifier mes informations</p>
                        </div>
                        <div class="h-12 w-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                            <i class="fas fa-user-cog text-white text-xl"></i>
                        </div>
                    </div>
                    <div class="flex items-center text-white/90 group-hover:text-white">
                        <span class="text-sm font-medium">Mettre à jour</span>
                        <i class="fas fa-arrow-right ml-2 text-sm group-hover:translate-x-1 transition-transform"></i>
                    </div>
                    <div class="mt-3 flex items-center space-x-2">
                        <div class="h-8 w-8 rounded-full bg-white/30 backdrop-blur-sm flex items-center justify-center text-white font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                        </div>
                        <div class="text-white/90 text-sm">
                            <span class="font-medium">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
