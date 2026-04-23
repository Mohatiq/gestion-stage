<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">{{ $offre->titre }}</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <div class="bg-white p-6 rounded shadow">
            <p class="text-gray-500">{{ $offre->societe->name }} — {{ $offre->ville }}</p>
            <p class="mt-4">{{ $offre->description }}</p>
            <div class="mt-4 text-sm text-gray-500">
                Durée : {{ $offre->duree }} mois |
                Rémunération : {{ $offre->remuneration ?? 'Non précisée' }} DH
            </div>

            @if(auth()->user()->role === 'etudiant')
                <a href="{{ route('candidatures.create', ['offre_id' => $offre->id]) }}"
                   class="mt-4 inline-block bg-green-500 text-white px-6 py-2 rounded">
                    Postuler
                </a>
            @endif
        </div>
    </div>
</x-app-layout>