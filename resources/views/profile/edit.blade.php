@extends('layouts.master')

@section('title', 'Mon Profil - StockMaster')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">

        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('dashboard') }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                            <i class="fas fa-arrow-left text-gray-600"></i>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">
                                Mon Profil
                            </h1>
                            <p class="text-sm text-gray-500">
                                <i class="far fa-user-circle mr-2"></i>Gérez vos informations personnelles
                            </p>
                        </div>
                    </div>
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-r from-orange-500 to-orange-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-6 py-8">
            <!-- Messages Flash -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center space-x-3 animate-fade-in">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span class="text-green-700">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center space-x-3 animate-fade-in">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                    <span class="text-red-700">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Grille principale -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Colonne gauche - Avatar et infos -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                        <!-- En-tête avec avatar -->
                        <div class="p-6 bg-gradient-to-r from-orange-500 to-orange-600 text-center">
                            <div class="relative inline-block">
                                <div class="h-24 w-24 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center mx-auto border-4 border-white/30">
                                    <span class="text-white text-4xl font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                </div>
                                <div class="absolute -bottom-2 -right-2 h-8 w-8 rounded-full bg-green-500 border-4 border-white flex items-center justify-center">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                            </div>
                            <h2 class="text-xl font-bold text-white mt-4">{{ Auth::user()->name }}</h2>
                            <p class="text-orange-100 text-sm flex items-center justify-center">
                                <i class="fas fa-circle text-xs mr-2 text-green-300"></i>
                                {{ ucfirst(Auth::user()->role) }}
                            </p>
                        </div>

                        <!-- Informations supplémentaires -->
                        <div class="p-6 space-y-4">
                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-xl">
                                <div class="h-10 w-10 rounded-lg bg-orange-100 flex items-center justify-center">
                                    <i class="fas fa-envelope text-orange-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Email</p>
                                    <p class="text-sm font-medium text-gray-800">{{ Auth::user()->email }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-xl">
                                <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                    <i class="fas fa-calendar-alt text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Membre depuis</p>
                                    <p class="text-sm font-medium text-gray-800">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-xl">
                                <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center">
                                    <i class="fas fa-clock text-purple-600"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Dernière mise à jour</p>
                                    <p class="text-sm font-medium text-gray-800">{{ Auth::user()->updated_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite - Formulaires -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Formulaire informations personnelles -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fas fa-user-edit text-orange-500 mr-3"></i>
                                Informations personnelles
                            </h2>
                        </div>

                        <div class="p-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Formulaire changement de mot de passe -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                                <i class="fas fa-lock text-orange-500 mr-3"></i>
                                Changer le mot de passe
                            </h2>
                        </div>

                        <div class="p-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Suppression de compte (Admin seulement) -->
                    @if(auth()->user()->role === 'admin')
                        <div class="bg-white rounded-2xl shadow-sm border border-red-200 overflow-hidden">
                            <div class="p-6 border-b border-red-100 bg-red-50">
                                <h2 class="text-lg font-semibold text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                                    Zone dangereuse
                                </h2>
                            </div>

                            <div class="p-6">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
