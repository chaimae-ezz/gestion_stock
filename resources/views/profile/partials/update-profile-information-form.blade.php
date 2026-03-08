<form method="post" action="{{ route('profile.update') }}" class="space-y-6">
    @csrf
    @method('patch')

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="fas fa-user text-orange-500 mr-2"></i>Nom complet
        </label>
        <input type="text"
               name="name"
               id="name"
               value="{{ old('name', Auth::user()->name) }}"
               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
               required>
        @error('name')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
            <i class="fas fa-envelope text-orange-500 mr-2"></i>Adresse email
        </label>
        <input type="email"
               name="email"
               id="email"
               value="{{ old('email', Auth::user()->email) }}"
               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors"
               required>
        @error('email')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-end">
        <button type="submit"
                class="px-6 py-2.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-xl hover:shadow-lg transition-all duration-300 flex items-center space-x-2">
            <i class="fas fa-save"></i>
            <span>Enregistrer</span>
        </button>
    </div>
</form>
