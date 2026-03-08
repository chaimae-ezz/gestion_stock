<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Gestion des Produits')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    @stack('styles')
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

</head>
<body class="bg-gray-100 min-h-screen">


<!-- Messages Flash -->
@if(session('success'))
    <div class=" flash-message bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
        <div class="flex">
            <div class="py-1">
                <i class="fas fa-check-circle mr-3"></i>
            </div>
            <div>
                <p class="font-bold">Succès</p>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
        <div class="flex">
            <div class="py-1">
                <i class="fas fa-exclamation-circle mr-3"></i>
            </div>
            <div>
                <p class="font-bold">Erreur</p>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    </div>
@endif

<!-- Contenu principal -->
<main class="container mx-auto px-4 py-8">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-6 mt-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <h3 class="text-xl font-bold mb-2">Gestion des Produits</h3>
                <p class="text-gray-400">Système de gestion d'inventaire</p>
            </div>
            <div class="text-center md:text-right">
                <p class="text-gray-400">&copy; {{ date('Y') }} Tous droits réservés</p>
                <p class="text-gray-400 text-sm">Version 1.0.0</p>
            </div>
        </div>
    </div>
</footer>

@stack('scripts')
</body>
</html>
