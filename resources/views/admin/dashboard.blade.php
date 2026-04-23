<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Dashboard Admin</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Statistiques --}}
        <div class="grid grid-cols-3 gap-4 mb-8">
            <div class="bg-blue-500 text-white p-5 rounded shadow text-center">
                <div class="text-3xl font-bold">{{ $totalUsers }}</div>
                <div class="mt-1">Utilisateurs</div>
            </div>
            <div class="bg-green-500 text-white p-5 rounded shadow text-center">
                <div class="text-3xl font-bold">{{ $totalOffres }}</div>
                <div class="mt-1">Offres publiées</div>
            </div>
            <div class="bg-yellow-500 text-white p-5 rounded shadow text-center">
                <div class="text-3xl font-bold">{{ $totalCandidatures }}</div>
                <div class="mt-1">Candidatures</div>
            </div>
        </div>

        {{-- Tableau utilisateurs --}}
        <div class="bg-white rounded shadow mb-8">
            <div class="p-4 border-b font-bold text-lg">Utilisateurs inscrits</div>
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3 text-left">Nom</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Rôle</th>
                        <th class="p-3 text-left">Inscrit le</th>
                        <th class="p-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3">{{ $user->email }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-xs font-medium
                                @if($user->role === 'admin') bg-red-100 text-red-700
                                @elseif($user->role === 'societe') bg-blue-100 text-blue-700
                                @else bg-green-100 text-green-700 @endif">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="p-3 text-gray-500">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>
                        <td class="p-3">
                            @if($user->id !== auth()->id())
                                <form method="POST"
                                      action="{{ route('admin.users.destroy', $user) }}"
                                      onsubmit="return confirm('Supprimer {{ $user->name }} ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500 hover:underline text-xs">
                                        Supprimer
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-300 text-xs">Vous</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Tableau candidatures --}}
        <div class="bg-white rounded shadow">
            <div class="p-4 border-b font-bold text-lg">Toutes les candidatures</div>
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3 text-left">Étudiant</th>
                        <th class="p-3 text-left">Offre</th>
                        <th class="p-3 text-left">Société</th>
                        <th class="p-3 text-left">Date</th>
                        <th class="p-3 text-left">Statut</th>
                        <th class="p-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($candidatures as $c)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $c->etudiant->name }}</td>
                        <td class="p-3">{{ $c->offre->titre }}</td>
                        <td class="p-3 text-gray-500">{{ $c->offre->societe->name }}</td>
                        <td class="p-3 text-gray-400">
                            {{ $c->created_at->format('d/m/Y') }}
                        </td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-xs font-medium
                                @if($c->statut === 'acceptee') bg-green-100 text-green-700
                                @elseif($c->statut === 'refusee') bg-red-100 text-red-700
                                @else bg-yellow-100 text-yellow-700 @endif">
                                {{ $c->statut }}
                            </span>
                        </td>
                        <td class="p-3">
                            <div class="flex gap-2">
                                <form method="POST"
                                      action="{{ route('admin.candidatures.update', $c) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="acceptee">
                                    <button class="text-green-600 hover:underline text-xs">
                                        Accepter
                                    </button>
                                </form>
                                <form method="POST"
                                      action="{{ route('admin.candidatures.update', $c) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="refusee">
                                    <button class="text-red-500 hover:underline text-xs">
                                        Refuser
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-400">
                                Aucune candidature pour le moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>