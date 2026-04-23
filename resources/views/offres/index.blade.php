<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Offres de stage</h2>
            @if(auth()->user()->role === 'societe')
                <a href="{{ route('offres.create') }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded">
                    + Publier une offre
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @forelse($offres as $offre)
            <div class="bg-white p-5 rounded shadow mb-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold">{{ $offre->titre }}</h3>
                        <p class="text-gray-500 text-sm">
                            {{ $offre->societe->name }} — {{ $offre->ville }}
                        </p>
                        <p class="text-gray-600 mt-2">{{ Str::limit($offre->description, 120) }}</p>
                        <div class="mt-2 text-sm text-gray-400">
                            Durée : {{ $offre->duree }} mois
                            @if($offre->remuneration)
                                | {{ $offre->remuneration }} DH/mois
                            @endif
                            @if($offre->date_limite)
                                | Limite : {{ $offre->date_limite }}
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 ml-4">
                        @if(auth()->user()->role === 'etudiant')
                            <a href="{{ route('candidatures.create', ['offre_id' => $offre->id]) }}"
                               class="bg-green-500 text-white px-4 py-2 rounded text-sm text-center">
                                Postuler
                            </a>
                        @endif

                        @if(auth()->user()->role === 'societe' && auth()->id() === $offre->societe_id)
                            <a href="{{ route('offres.edit', $offre) }}"
                               class="bg-yellow-400 text-white px-4 py-2 rounded text-sm text-center">
                                Modifier
                            </a>
                            <form method="POST" action="{{ route('offres.destroy', $offre) }}">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-4 py-2 rounded text-sm w-full">
                                    Supprimer
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Aucune offre disponible pour le moment.</p>
        @endforelse
        {{ $offres->links() }}
    </div>
</x-app-layout>