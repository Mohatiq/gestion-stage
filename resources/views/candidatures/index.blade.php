<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Mes Candidatures</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        @foreach($candidatures as $c)
        <div class="bg-white p-4 rounded shadow mb-4">
            <h3 class="font-bold">{{ $c->offre->titre }}</h3>
            <p class="text-gray-500">{{ $c->offre->entreprise }}</p>
            <span class="px-2 py-1 rounded text-sm
                @if($c->statut == 'accepte') bg-green-200
                @elseif($c->statut == 'refuse') bg-red-200
                @else bg-yellow-200 @endif">
                {{ $c->statut }}
            </span>
        </div>
        @endforeach
    </div>
</x-app-layout>