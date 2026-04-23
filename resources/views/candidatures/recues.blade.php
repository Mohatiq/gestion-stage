<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Candidatures reçues</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @forelse($offres as $offre)
            <div class="bg-white rounded shadow mb-6">

                {{-- En-tête de l'offre --}}
                <div class="p-4 border-b bg-indigo-50 rounded-t">
                    <h3 class="font-bold text-lg text-indigo-700">
                        {{ $offre->titre }}
                    </h3>
                    <p class="text-sm text-gray-500">
                        {{ $offre->ville }} — {{ $offre->duree }} mois
                        — {{ $offre->candidatures->count() }} candidature(s)
                    </p>
                </div>

                @forelse($offre->candidatures as $c)
                    <div class="p-4 border-b flex justify-between items-center">

                        {{-- Infos étudiant --}}
                        <div class="flex-1">
                            <p class="font-medium">{{ $c->etudiant->name }}</p>
                            <p class="text-sm text-gray-500">{{ $c->etudiant->email }}</p>
                            <p class="text-sm text-gray-600 mt-1 italic">
                                "{{ Str::limit($c->message, 100) }}"
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                Postulé le {{ $c->created_at->format('d/m/Y') }}
                            </p>
                        </div>

                        {{-- Statut actuel --}}
                        <div class="mx-6">
                            <span class="px-3 py-1 rounded-full text-xs font-medium
                                @if($c->statut === 'acceptee') bg-green-100 text-green-700
                                @elseif($c->statut === 'refusee') bg-red-100 text-red-700
                                @else bg-yellow-100 text-yellow-700 @endif">
                                {{ ucfirst($c->statut) }}
                            </span>
                        </div>

                        {{-- Boutons décision --}}
                        <div class="flex gap-2">
                            <form method="POST"
                                  action="{{ route('candidatures.decider', $c) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="statut" value="acceptee">
                                <button
                                    class="bg-green-500 hover:bg-green-600 text-white
                                           px-4 py-2 rounded text-sm transition">
                                    Accepter
                                </button>
                            </form>

                            <form method="POST"
                                  action="{{ route('candidatures.decider', $c) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="statut" value="refusee">
                                <button
                                    class="bg-red-500 hover:bg-red-600 text-white
                                           px-4 py-2 rounded text-sm transition">
                                    Refuser
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="p-4 text-gray-400 text-sm">
                        Aucune candidature pour cette offre.
                    </p>
                @endforelse
            </div>
        @empty
            <div class="bg-white p-8 rounded shadow text-center text-gray-400">
                Vous n'avez pas encore publié d'offres.
            </div>
        @endforelse
    </div>
</x-app-layout>