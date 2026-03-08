@extends('layouts.master')

@section('title', 'Gestion des Utilisateurs - StockMaster')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">

        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-red-500/20">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">
                                Gestion des Utilisateurs
                            </h1>
                            <p class="text-sm text-gray-500">
                                <i class="far fa-users mr-2"></i>{{ $users->total() }} utilisateurs enregistrés
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('users.create') }}"
                           class="px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                            <i class="fas fa-plus-circle"></i>
                            <span>Nouvel utilisateur</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Total</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $users->total() }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center">
                            <i class="fas fa-users text-orange-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Administrateurs</p>
                            <h3 class="text-2xl font-bold text-purple-600">{{ $users->where('role', 'admin')->count() }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center">
                            <i class="fas fa-crown text-purple-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Employés</p>
                            <h3 class="text-2xl font-bold text-blue-600">{{ $users->where('role', 'employe')->count() }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center">
                            <i class="fas fa-user-tie text-blue-500 text-xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Actifs</p>
                            <h3 class="text-2xl font-bold text-green-600">{{ $users->total() }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Messages Flash -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-center space-x-3">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span class="text-green-700">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-center space-x-3">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                    <span class="text-red-700">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Tableau des utilisateurs -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Utilisateur</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Rôle</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Inscription</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center text-white font-bold shadow-lg">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-xs text-gray-500">ID: #{{ $user->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->role === 'admin')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 border border-purple-200">
                                        <i class="fas fa-crown mr-1 text-xs"></i> Administrateur
                                    </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 border border-blue-200">
                                        <i class="fas fa-user mr-1 text-xs"></i> Employé
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">{{ $user->created_at->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="{{ route('users.edit', $user) }}"
                                           class="p-2 bg-orange-50 text-orange-600 rounded-lg hover:bg-orange-100 transition-colors"
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors"
                                                        title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="p-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <i class="fas fa-users-slash text-5xl mb-4"></i>
                                        <p class="text-lg font-medium">Aucun utilisateur trouvé</p>
                                        <p class="text-sm">Commencez par créer un nouvel utilisateur</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
