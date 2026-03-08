@extends('layouts.master')

@section('title', 'Ajouter un Fournisseur')

@section('content')
    <div class="px-4 py-5 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center">
                <a href="{{ route('fournisseurs.index') }}"
                   class="text-primary-600 hover:text-primary-900 mr-4">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Ajouter un nouveau fournisseur</h2>
                    <p class="mt-1 text-sm text-gray-600">Remplissez les informations ci-dessous</p>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow sm:rounded-lg">
                <form action="{{ route('fournisseurs.store') }}" method="POST">
                    @csrf

                    <div class="px-4 py-5 sm:p-6">
                        <!-- Form Sections -->
                        <div class="space-y-8 divide-y divide-gray-200">
                            <!-- Informations de base -->
                            <div class="space-y-6">
                                <div>
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Informations principales</h3>
                                    <p class="mt-1 text-sm text-gray-500">Informations essentielles du fournisseur</p>
                                </div>

                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <!-- Nom -->
                                    <div>
                                        <label for="nom" class="block text-sm font-medium text-gray-700">
                                            Nom du fournisseur *
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-building text-gray-400"></i>
                                            </div>
                                            <input type="text"
                                                   name="nom"
                                                   id="nom"
                                                   required
                                                   value="{{ old('nom') }}"
                                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('nom') border-red-300 @enderror"
                                                   placeholder="Ex: TechDistrib SARL">
                                            @error('nom')
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fas fa-exclamation-circle text-red-500"></i>
                                            </div>
                                            @enderror
                                        </div>
                                        @error('nom')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">
                                            Adresse email
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-envelope text-gray-400"></i>
                                            </div>
                                            <input type="email"
                                                   name="email"
                                                   id="email"
                                                   value="{{ old('email') }}"
                                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('email') border-red-300 @enderror"
                                                   placeholder="contact@entreprise.com">
                                            @error('email')
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fas fa-exclamation-circle text-red-500"></i>
                                            </div>
                                            @enderror
                                        </div>
                                        @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Téléphone -->
                                    <div>
                                        <label for="telephone" class="block text-sm font-medium text-gray-700">
                                            Numéro de téléphone
                                        </label>
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-phone text-gray-400"></i>
                                            </div>
                                            <input type="tel"
                                                   name="telephone"
                                                   id="telephone"
                                                   value="{{ old('telephone') }}"
                                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('telephone') border-red-300 @enderror"
                                                   placeholder="01 23 45 67 89">
                                            @error('telephone')
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fas fa-exclamation-circle text-red-500"></i>
                                            </div>
                                            @enderror
                                        </div>
                                        @error('telephone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Adresse -->
                                    <div class="sm:col-span-2">
                                        <label for="adresse" class="block text-sm font-medium text-gray-700">
                                            Adresse
                                        </label>
                                        <div class="mt-1">
                                        <textarea name="adresse"
                                                  id="adresse"
                                                  rows="3"
                                                  class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm @error('adresse') border-red-300 @enderror"
                                                  placeholder="Adresse complète">{{ old('adresse') }}</textarea>
                                        </div>
                                        @error('adresse')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Informations supplémentaires -->

                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 rounded-b-lg">
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('fournisseurs.index') }}"
                               class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Annuler
                            </a>
                            <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <i class="fas fa-save mr-2"></i> Enregistrer le fournisseur
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            input:focus, textarea:focus, select:focus {
                outline: none;
                ring: 2px;
                ring-color: #3b82f6;
            }
        </style>
    @endpush
@endsection
