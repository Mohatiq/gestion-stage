<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Postuler — {{ $offre->titre }}</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto px-4">

        {{-- Affichage des erreurs --}}
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>— {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Affichage erreur déjà postulé --}}
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded shadow mb-4">
            <h3 class="font-bold text-lg">{{ $offre->titre }}</h3>
            <p class="text-gray-500 text-sm">{{ $offre->ville }} — {{ $offre->duree }} mois</p>
        </div>

        <form method="POST" action="{{ route('candidatures.store') }}"
              class="bg-white p-6 rounded shadow">
            @csrf
            <input type="hidden" name="offre_id" value="{{ $offre->id }}">

            <div class="mb-4">
                <label class="block font-medium mb-1">
                    Message de motivation
                    <span class="text-gray-400 text-sm font-normal">(minimum 10 caractères)</span>
                </label>
                <textarea name="message" rows="6"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    required>{{ old('message') }}</textarea>
            </div>

            <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded w-full transition">
                Envoyer ma candidature
            </button>
        </form>
    </div>
</x-app-layout>