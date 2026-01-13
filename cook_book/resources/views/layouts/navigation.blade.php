<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20 gap-4">
            <!-- Logo Section -->
            <div class="flex items-center flex-shrink-0">
                <a href="{{ auth()->check() ? route('dashboard') : route('home') }}" class="flex items-center space-x-3 group">
                    <x-application-logo class="block h-14 w-14 object-contain" />
                    <span class="text-3xl font-bold bg-clip-text text-transparent" style="font-family: 'Dancing Script', cursive; background: linear-gradient(to right, #6A994E, #A7C957); -webkit-background-clip: text;">
                        CookBook
                    </span>
                    </a>
                </div>

            <!-- Desktop Navigation - Barre de recherche -->
            <div class="hidden md:flex md:items-center flex-1 max-w-lg mx-4">
                <form action="{{ route('recettes.index') }}" method="GET" class="w-full">
                    @if(request('all'))
                        <input type="hidden" name="all" value="1">
                    @endif
                    <div class="relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Rechercher une recette..." 
                            class="w-full pl-10 pr-10 py-2.5 border-2 border-gray-300 rounded-lg focus:border-olive focus:ring-2 focus:ring-green-light/50 transition-all duration-200 text-sm"
                            style="--tw-ring-color: #6A994E;"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>
                        @if(request('search'))
                            <a href="{{ route('recettes.index', request('all') ? ['all' => 1] : []) }}" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg class="w-5 h-5 text-gray-400 hover:text-gray-600 cursor-pointer transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex md:items-center md:space-x-1 flex-shrink-0">
                <a href="{{ route('recettes.index') }}" 
                   class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('recettes.*') ? 'bg-cream' : 'text-gray-700 hover:bg-cream' }}" style="{{ request()->routeIs('recettes.*') ? 'color: #6A994E;' : '' }}" onmouseover="if(!this.classList.contains('bg-cream')) this.style.color='#6A994E'" onmouseout="if(!this.classList.contains('bg-cream')) this.style.color=''" title="Recettes">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                </a>
                @auth
                    <a href="{{ route('favoris.index') }}" 
                       class="px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 relative {{ request()->routeIs('favoris.*') ? 'bg-cream' : 'text-gray-700 hover:bg-cream' }}" style="{{ request()->routeIs('favoris.*') ? 'color: #6A994E;' : '' }}" onmouseover="if(!this.classList.contains('bg-cream')) this.style.color='#6A994E'" onmouseout="if(!this.classList.contains('bg-cream')) this.style.color=''">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            Favoris
                            @php
                                $favoritesCount = auth()->user()->favoriteRecipes()->count();
                            @endphp
                            @if($favoritesCount > 0)
                                <span class="ml-1 px-2 py-0.5 text-xs font-bold rounded-full text-white" style="background: linear-gradient(to right, #6A994E, #A7C957); min-width: 20px; text-align: center; display: inline-flex; align-items: center; justify-content: center;">
                                    {{ $favoritesCount }}
                                </span>
                            @endif
                        </span>
                    </a>
                @endauth
            </div>

            <!-- Right Side Actions -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                @auth
                    <!-- User Menu -->
                    <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                            <button class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-cream transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2" style="--tw-ring-color: #6A994E;">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md" style="background: linear-gradient(to bottom right, #6A994E, #A7C957);">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <div class="hidden lg:block text-left">
                                    <div class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                                </div>
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil
                                </span>
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <span class="flex items-center gap-2 text-red-600">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Déconnexion
                                    </span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" 
                           class="px-4 py-2 text-sm font-medium text-gray-700 transition-colors" onmouseover="this.style.color='#6A994E'" onmouseout="this.style.color=''">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" 
                           class="px-5 py-2.5 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105" style="background: linear-gradient(to right, #6A994E, #A7C957);" onmouseover="this.style.background='linear-gradient(to right, #5a8840, #97b947)'" onmouseout="this.style.background='linear-gradient(to right, #6A994E, #A7C957)'">
                            Inscription
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="open = ! open" 
                        class="p-2 rounded-lg text-gray-600 hover:bg-cream focus:outline-none focus:ring-2 transition-all" style="--tw-ring-color: #6A994E;" onmouseover="this.style.color='#6A994E'" onmouseout="this.style.color=''">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{'hidden': open, 'block': !open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'block': open}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="md:hidden border-t border-gray-200 bg-white">
        <!-- Barre de recherche mobile -->
        <div class="px-4 pt-3 pb-2">
            <form action="{{ route('recettes.index') }}" method="GET">
                @if(request('all'))
                    <input type="hidden" name="all" value="1">
                @endif
                <div class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}"
                        placeholder="Rechercher une recette..." 
                        class="w-full pl-10 pr-10 py-2.5 border-2 border-gray-300 rounded-lg focus:border-olive focus:ring-2 focus:ring-green-light/50 transition-all duration-200"
                        style="--tw-ring-color: #6A994E;"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    @if(request('search'))
                        <a href="{{ route('recettes.index', request('all') ? ['all' => 1] : []) }}" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="w-5 h-5 text-gray-400 hover:text-gray-600 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </div>
            </form>
        </div>
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('recettes.index') }}" 
               class="block px-4 py-3 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('recettes.*') ? 'bg-cream' : 'text-gray-700 hover:bg-cream' }}" style="{{ request()->routeIs('recettes.*') ? 'color: #6A994E;' : '' }}" onmouseover="if(!this.classList.contains('bg-cream')) this.style.color='#6A994E'" onmouseout="if(!this.classList.contains('bg-cream')) this.style.color=''" title="Recettes">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                    <span>Recettes</span>
                </span>
            </a>
            @auth
                <a href="{{ route('favoris.index') }}" 
                   class="block px-4 py-3 text-base font-medium rounded-lg transition-colors {{ request()->routeIs('favoris.*') ? 'bg-cream' : 'text-gray-700 hover:bg-cream' }}" style="{{ request()->routeIs('favoris.*') ? 'color: #6A994E;' : '' }}" onmouseover="if(!this.classList.contains('bg-cream')) this.style.color='#6A994E'" onmouseout="if(!this.classList.contains('bg-cream')) this.style.color=''">
                    <span class="flex items-center justify-between">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            Mes favoris
                        </span>
                        @php
                            $favoritesCount = auth()->user()->favoriteRecipes()->count();
                        @endphp
                        @if($favoritesCount > 0)
                            <span class="px-2 py-0.5 text-xs font-bold rounded-full text-white" style="background: linear-gradient(to right, #6A994E, #A7C957); min-width: 20px; text-align: center; display: inline-flex; align-items: center; justify-content: center;">
                                {{ $favoritesCount }}
                            </span>
                        @endif
                    </span>
                </a>
            @endauth
        </div>

        <!-- Mobile Auth Section -->
        <div class="border-t border-gray-200 pt-4 pb-4">
            @auth
                <div class="px-4 mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold shadow-md" style="background: linear-gradient(to bottom right, #6A994E, #A7C957);">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
            </div>
                <div class="px-2 space-y-1">
                    <a href="{{ route('profile.edit') }}" 
                       class="block px-4 py-3 text-base font-medium text-gray-700 hover:bg-cream rounded-lg transition-colors" onmouseover="this.style.color='#6A994E'" onmouseout="this.style.color=''">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profil
                        </span>
                    </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <button type="submit" 
                                class="w-full text-left block px-4 py-3 text-base font-medium text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Déconnexion
                            </span>
                        </button>
                </form>
            </div>
            @else
                <div class="px-2 space-y-2">
                    <a href="{{ route('login') }}" 
                       class="block w-full text-center px-4 py-3 text-base font-medium text-gray-700 hover:bg-cream rounded-lg transition-colors" onmouseover="this.style.color='#6A994E'" onmouseout="this.style.color=''">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}" 
                       class="block w-full text-center px-4 py-3 text-white text-base font-semibold rounded-lg shadow-md hover:shadow-lg transition-all" style="background: linear-gradient(to right, #6A994E, #A7C957);" onmouseover="this.style.background='linear-gradient(to right, #5a8840, #97b947)'" onmouseout="this.style.background='linear-gradient(to right, #6A994E, #A7C957)'">
                        Inscription
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
