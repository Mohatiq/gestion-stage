<nav x-data="{ open: false }" class="bg-indigo-700 border-b border-indigo-800 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo + liens principaux -->
            <div class="flex items-center">
                <a href="/" class="text-white font-bold text-xl tracking-wide mr-10">
                    Stage<span class="text-indigo-300">Maroc</span>
                </a>

                <div class="hidden sm:flex space-x-2">
                    <a href="{{ route('offres.index') }}"
                       class="text-indigo-100 hover:bg-indigo-600 hover:text-white
                              px-3 py-2 rounded-md text-sm font-medium transition">
                        Offres de stage
                    </a>

                    @if(auth()->user()->role === 'etudiant')
                        <a href="{{ route('candidatures.index') }}"
                           class="text-indigo-100 hover:bg-indigo-600 hover:text-white
                                  px-3 py-2 rounded-md text-sm font-medium transition">
                            Mes candidatures
                        </a>
                    @endif

                    @if(auth()->user()->role === 'societe')
                        <a href="{{ route('offres.create') }}"
                           class="bg-white text-indigo-700 hover:bg-indigo-50
                                  px-3 py-2 rounded-md text-sm font-medium transition">
                            + Publier une offre
                        </a>
                        <a href="{{ route('candidatures.recues') }}"
                           class="text-indigo-100 hover:bg-indigo-600 hover:text-white
                                  px-3 py-2 rounded-md text-sm font-medium transition">
                            Candidatures reçues
                        </a>
                    @endif

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="bg-red-500 text-white hover:bg-red-600
                                  px-3 py-2 rounded-md text-sm font-medium transition">
                            Dashboard Admin
                        </a>
                    @endif
                </div>
            </div>

            <!-- Menu utilisateur droite -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">

                <!-- Badge rôle -->
                <span class="px-2 py-1 rounded text-xs font-medium
                    @if(auth()->user()->role === 'admin') bg-red-500 text-white
                    @elseif(auth()->user()->role === 'societe') bg-blue-400 text-white
                    @else bg-green-400 text-white @endif">
                    {{ ucfirst(auth()->user()->role) }}
                </span>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border
                                       border-indigo-400 text-sm font-medium rounded-md
                                       text-white bg-indigo-600 hover:bg-indigo-500
                                       transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Mon profil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                         this.closest('form').submit();">
                                Se déconnecter
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="p-2 rounded-md text-indigo-200 hover:text-white
                               hover:bg-indigo-600 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open}"
                              class="inline-flex" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open}"
                              class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu mobile -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-indigo-800">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <x-responsive-nav-link :href="route('offres.index')">
                Offres de stage
            </x-responsive-nav-link>

            @if(auth()->user()->role === 'etudiant')
                <x-responsive-nav-link :href="route('candidatures.index')">
                    Mes candidatures
                </x-responsive-nav-link>
            @endif

            @if(auth()->user()->role === 'societe')
                <x-responsive-nav-link :href="route('offres.create')">
                    + Publier une offre
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('candidatures.recues')">
                    Candidatures reçues
                </x-responsive-nav-link>
            @endif

            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')">
                    Dashboard Admin
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Infos utilisateur mobile -->
        <div class="pt-4 pb-1 border-t border-indigo-600">
            <div class="px-4">
                <div class="font-medium text-base text-white">
                    {{ Auth::user()->name }}
                </div>
                <div class="font-medium text-sm text-indigo-300">
                    {{ Auth::user()->email }}
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Mon profil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                 this.closest('form').submit();">
                        Se déconnecter
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>