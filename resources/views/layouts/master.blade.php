<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Gestion Stock')</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                    }
                }
            }
        }
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                transform: translateY(10px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .input-focus:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alerts = document.querySelectorAll('.flash-message');

            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';

                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 4000); // 4 secondes
            });
        });
    </script>

    @stack('styles')
</head>
<body class="font-sans antialiased">
<!-- Navigation -->
<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a class="flex-shrink-0 flex items-center">
                    <div class="h-8 w-8 bg-primary-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-box text-white text-sm"></i>
                    </div>
                    <a href="{{ route('dashboard') }}"><span class="ml-2 text-xl font-bold text-gray-800">StockMaster</span></a>
                </a>

                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('fournisseurs.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-gray-900 hover:border-gray-300">
                        Fournisseurs
                    </a>
                    <a href="{{ route('produits.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-gray-900 hover:border-gray-300">
                        Produits
                    </a>
                    <a href="{{ route('mouvements.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-gray-900 hover:border-gray-300">
                        Mouvements
                    </a>

                    <a href="{{ route('statistique') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-gray-900 hover:border-gray-300">
                        Statistiques
                    </a>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Icône d'alerte de seuil -->
                <!-- Icône d'alerte de seuil -->
                @auth
                    @php
                        $alertes = \App\Models\Produit::whereColumn('quantite_stock', '<=', 'seuil_alerte')->count();
                    @endphp

                    <div class="relative">
                        <a href="{{ route('produits.alertes') }}"
                        class="p-2 text-gray-500 hover:text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors relative"
                        title="Produits en alerte">
                        <i class="fas fa-exclamation-triangle text-lg"></i>
                        @if($alertes > 0)
                            <span class="absolute -top-1 -right-1 h-5 w-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center animate-pulse">
                    {{ $alertes }}
                </span>
                            @endif
                            </a>
                    </div>
                @endauth

                <!-- Profil utilisateur -->
                @auth
                    <div class="ml-3 relative">
                        <div class="flex items-center space-x-4">
                            <span class="text-sm text-gray-700">{{ Auth::user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
<!-- Main Content -->
<div class="py-10">
    <main>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Notifications -->
            @if(session('success'))
                <div class="flash-message mb-6 bg-green-50 border-l-4 border-green-500 p-4 animate-fade-in">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="flash-message mb-6 bg-red-50 border-l-4 border-red-500 p-4 animate-fade-in">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg animate-slide-up">
                @yield('content')
            </div>
        </div>
    </main>
</div>

<!-- Scripts -->
<script>
    // Auto-hide alerts after 5 seconds


    // Confirm delete
    function confirmDelete(message = 'Êtes-vous sûr de vouloir supprimer ?') {
        return confirm(message);
    }

    // Copy to clipboard
    function copyToClipboard(text, elementId) {
        navigator.clipboard.writeText(text).then(() => {
            const btn = document.getElementById(elementId);
            const original = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check mr-1"></i> Copié';
            btn.classList.add('bg-green-500');
            setTimeout(() => {
                btn.innerHTML = original;
                btn.classList.remove('bg-green-500');
            }, 2000);
        });
    }
</script>

@stack('scripts')
</body>
</html>
