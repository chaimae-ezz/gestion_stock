@extends('layouts.master')

@section('title', 'Modifier un utilisateur - StockMaster')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">

        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('users.index') }}" class="p-2 hover:bg-gray-100 rounded-lg transition-colors">
                        <i class="fas fa-arrow-left text-gray-600"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">
                            Modifier l'utilisateur
                        </h1>
                        <p class="text-sm text-gray-500">
                            <i class="far fa-edit mr-2"></i>{{ $user->name }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-6 py-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- En-tête du formulaire avec avatar -->
                    <div class="p-6 bg-gradient-to-r from-orange-500 to-orange-600">
                        <div class="flex items-center space-x-4">
                            <div class="h-20 w-20 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                <span class="text-white text-3xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-white">{{ $user->name }}</h2>
                                <p class="text-orange-100 text-sm">Modifiez les informations de l'utilisateur</p>
                            </div>
                        </div>
                    </div>

                    <!-- Corps du formulaire -->
                    <div class="p-6 space-y-6">
                        <!-- Nom complet -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-user text-orange-500 mr-2"></i>Nom complet
                            </label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                                   required>
                            @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-envelope text-orange-500 mr-2"></i>Adresse email
                            </label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                                   required>
                            @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nouveau mot de passe (optionnel) -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-lock text-orange-500 mr-2"></i>Nouveau mot de passe
                                <span class="text-xs text-gray-400 ml-2">(laisser vide pour conserver l'actuel)</span>
                            </label>
                            <div class="relative">
                                <input type="password"
                                       name="password"
                                       id="password"
                                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                                       placeholder="••••••••">
                                <button type="button"
                                        onclick="togglePassword()"
                                        class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rôle -->
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-user-tag text-orange-500 mr-2"></i>Rôle
                            </label>
                            <select name="role"
                                    id="role"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
                                    required>
                                <option value="admin" {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Administrateur</option>
                                <option value="employe" {{ (old('role', $user->role) == 'employe') ? 'selected' : '' }}>Employé</option>
                            </select>
                            @error('role')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Avertissement pour son propre compte -->
                        @if($user->id === auth()->id())
                            <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-exclamation-triangle text-yellow-500 mt-1"></i>
                                    <div>
                                        <h4 class="text-sm font-medium text-yellow-800">Vous modifiez votre propre compte</h4>
                                        <p class="text-xs text-yellow-600 mt-1">
                                            Soyez prudent : certaines modifications peuvent affecter vos permissions.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Footer avec boutons -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end space-x-3">
                        <a href="{{ route('users.index') }}"
                           class="px-6 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-100 transition-colors">
                            Annuler
                        </a>
                        <button type="submit"
                                class="px-6 py-2.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                            <i class="fas fa-save"></i>
                            <span>Mettre à jour</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = event.currentTarget.querySelector('i');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
