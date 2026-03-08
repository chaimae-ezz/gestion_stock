<section class="space-y-6">
    <header>
        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
            <i class="fas fa-lock text-orange-500 mr-3"></i>
            {{ __('Changer le mot de passe') }}
        </h2>
        <p class="mt-1 text-sm text-gray-500">
            <i class="fas fa-info-circle text-orange-400 mr-1"></i>
            {{ __('Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <!-- Mot de passe actuel -->
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-lock text-orange-500 mr-2"></i>
                {{ __('Mot de passe actuel') }}
            </label>
            <div class="relative">
                <input id="update_password_current_password"
                       name="current_password"
                       type="password"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors pr-12"
                       placeholder="••••••••"
                       autocomplete="current-password">
                <button type="button"
                        onclick="togglePassword('update_password_current_password')"
                        class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('current_password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nouveau mot de passe -->
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-key text-orange-500 mr-2"></i>
                {{ __('Nouveau mot de passe') }}
            </label>
            <div class="relative">
                <input id="update_password_password"
                       name="password"
                       type="password"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors pr-12"
                       placeholder="••••••••"
                       autocomplete="new-password">
                <button type="button"
                        onclick="togglePassword('update_password_password')"
                        class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmation mot de passe -->
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-check-circle text-orange-500 mr-2"></i>
                {{ __('Confirmer le mot de passe') }}
            </label>
            <div class="relative">
                <input id="update_password_password_confirmation"
                       name="password_confirmation"
                       type="password"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors pr-12"
                       placeholder="••••••••"
                       autocomplete="new-password">
                <button type="button"
                        onclick="togglePassword('update_password_password_confirmation')"
                        class="absolute right-3 top-3 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <!-- Boutons et message de succès ICI -->
        <div class="flex items-center justify-between pt-4">
            <button type="submit"
                    class="px-6 py-2.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
                <i class="fas fa-save"></i>
                <span>{{ __('Enregistrer') }}</span>
            </button>

            <!-- MESSAGE DE SUCCÈS - Placé ici -->
            @if (session('status') === 'password-updated')
                <div class="flex items-center space-x-2 text-sm text-green-600 animate-fade-in bg-green-50 px-4 py-2 rounded-xl border border-green-200">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span class="font-medium">✓ Mot de passe modifié avec succès !</span>
                </div>
            @endif
        </div>
    </form>
</section>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = event.currentTarget.querySelector('i');

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-in-out;
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
