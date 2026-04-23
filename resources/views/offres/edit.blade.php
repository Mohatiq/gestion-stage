<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Modifier l'offre</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto px-4">

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>— {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('offres.update', $offre) }}"
              class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium mb-1">Titre</label>
                <input type="text" name="titre"
                       value="{{ old('titre', $offre->titre) }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Description</label>
                <textarea name="description" rows="5"
                          class="w-full border rounded px-3 py-2"
                          required>{{ old('description', $offre->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-medium mb-1">Ville</label>
                <input type="text" name="ville"
                       value="{{ old('ville', $offre->ville) }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block font-medium mb-1">Durée (mois)</label>
                    <input type="number" name="duree"
                           value="{{ old('duree', $offre->duree) }}"
                           class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">Rémunération</label>
                    <input type="number" name="remuneration"
                           value="{{ old('remuneration', $offre->remuneration) }}"
                           class="w-full border rounded px-3 py-2" step="0.01">
                </div>
            </div>

            <div class="mb-6">
                <label class="block font-medium mb-1">Date limite</label>
                <input type="date" name="date_limite"
                       value="{{ old('date_limite', $offre->date_limite) }}"
                       class="w-full border rounded px-3 py-2">
            </div>

            <button type="submit"
                    class="bg-yellow-500 text-white px-6 py-2 rounded w-full">
                Enregistrer les modifications
            </button>
        </form>
    </div>
</x-app-layout>