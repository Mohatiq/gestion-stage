<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Postuler — {{ $offre->titre }}</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto">
        <form method="POST" action="{{ route('candidatures.store') }}">
            @csrf
            <input type="hidden" name="offre_id" value="{{ $offre->id }}">

            <div class="mb-4">
                <label class="block font-medium">Message de motivation</label>
                <textarea name="message" rows="5"
                    class="w-full border rounded px-3 py-2" required></textarea>
            </div>

            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded">
                Envoyer ma candidature
            </button>
        </form>
    </div>
</x-app-layout>