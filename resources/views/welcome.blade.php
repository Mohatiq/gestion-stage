<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StageMaroc — Trouvez votre stage</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

    <!-- Hero -->
    <div class="min-h-screen bg-gradient-to-br from-indigo-700 to-indigo-900
                flex flex-col items-center justify-center text-white px-4">

        <h1 class="text-5xl font-bold mb-4 text-center">
            Stage<span class="text-indigo-300">Maroc</span>
        </h1>
        <p class="text-xl text-indigo-200 mb-10 text-center max-w-xl">
            La plateforme qui connecte les étudiants aux meilleures
            opportunités de stage au Maroc
        </p>

        <div class="flex gap-4 flex-wrap justify-center">
            <a href="{{ route('login') }}"
               class="bg-white text-indigo-700 font-semibold px-8 py-3
                      rounded-lg hover:bg-indigo-50 transition text-lg">
                Se connecter
            </a>
            <a href="{{ route('register') }}"
               class="border-2 border-white text-white font-semibold px-8 py-3
                      rounded-lg hover:bg-indigo-600 transition text-lg">
                Créer un compte
            </a>
        </div>

        <!-- 3 cartes info -->
        <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-3xl w-full">
            <div class="bg-indigo-600 bg-opacity-50 rounded-xl p-6 text-center">
                <div class="text-3xl font-bold mb-2">Étudiant</div>
                <p class="text-indigo-200 text-sm">
                    Parcourez les offres et postulez en quelques clics
                </p>
            </div>
            <div class="bg-indigo-600 bg-opacity-50 rounded-xl p-6 text-center">
                <div class="text-3xl font-bold mb-2">Société</div>
                <p class="text-indigo-200 text-sm">
                    Publiez vos offres et gérez les candidatures
                </p>
            </div>
            <div class="bg-indigo-600 bg-opacity-50 rounded-xl p-6 text-center">
                <div class="text-3xl font-bold mb-2">Gratuit</div>
                <p class="text-indigo-200 text-sm">
                    Plateforme 100% gratuite pour tous
                </p>
            </div>
        </div>
    </div>

</body>
</html>