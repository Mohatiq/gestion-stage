<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full"
                type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Rôle -->
        <div class="mt-4">
            <x-input-label for="role" :value="'Je suis un(e)'" />
            <select name="role" id="role"
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm
                       focus:ring-indigo-500 focus:border-indigo-500">
                <option value="etudiant" {{ old('role') == 'etudiant' ? 'selected' : '' }}>
                    Étudiant
                </option>
                <option value="societe" {{ old('role') == 'societe' ? 'selected' : '' }}>
                    Société
                </option>
            </select>
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password"
                required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation"
                :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation"
                required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
               href="{{ route('login') }}">
                Déjà inscrit ?
            </a>
            <x-primary-button class="ms-4">
                S'inscrire
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>