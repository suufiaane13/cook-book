<x-app-layout>
    <!-- Hero Section -->
    <div class="relative overflow-hidden" style="background: linear-gradient(to bottom right, #6A994E, #A7C957);">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32">
            <div class="text-center">
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white mb-6">
                    Bienvenue sur CookBook
                </h1>
                <p class="text-xl sm:text-2xl mb-8 max-w-3xl mx-auto" style="color: rgba(255, 255, 255, 0.95);">
                    Découvrez et partagez vos recettes préférées avec une communauté passionnée de cuisine
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('recettes.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white rounded-lg font-semibold text-lg shadow-xl focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 transition-all duration-200 transform hover:scale-105" style="color: #6A994E;" onmouseover="this.style.backgroundColor='#F2F2F2'" onmouseout="this.style.backgroundColor='white'">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                        Explorer les recettes
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 text-white rounded-lg font-semibold text-lg shadow-xl focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px);" onmouseover="this.style.background='rgba(255, 255, 255, 0.3)'" onmouseout="this.style.background='rgba(255, 255, 255, 0.2)'">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Créer un compte
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>

    <!-- Recettes récentes -->
    <div class="py-16" style="background: linear-gradient(to bottom right, #F2F2F2, #ffffff, #F2F2F2);">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    Dernières recettes
                </h2>
                <p class="text-xl text-gray-600">
                    Découvrez les recettes les plus récentes partagées par notre communauté
                </p>
            </div>

            @php
                $recentRecipes = \App\Models\Recipe::with(['user', 'ingredients', 'etapes'])
                    ->latest()
                    ->take(6)
                    ->get();
            @endphp

            @if($recentRecipes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($recentRecipes as $recipe)
                        <x-recipe-card :recipe="$recipe" />
                    @endforeach
                </div>

                <div class="text-center">
                    <a href="{{ route('recettes.index') }}" class="inline-flex items-center gap-2 px-8 py-4 text-white rounded-lg font-semibold text-lg shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105" style="background: linear-gradient(to right, #6A994E, #A7C957);" onmouseover="this.style.background='linear-gradient(to right, #5a8840, #97b947)'" onmouseout="this.style.background='linear-gradient(to right, #6A994E, #A7C957)'">
                        Voir toutes les recettes
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-16 text-center">
                        <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full mb-6" style="background-color: #F2F2F2;">
                            <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color: #6A994E;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">
                            Aucune recette pour le moment
                        </h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">
                            Soyez le premier à partager votre recette préférée avec la communauté !
                        </p>
                        @auth
                            <a href="{{ route('recettes.create') }}" class="inline-flex items-center gap-2 px-6 py-3 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105" style="background: linear-gradient(to right, #6A994E, #A7C957);" onmouseover="this.style.background='linear-gradient(to right, #5a8840, #97b947)'" onmouseout="this.style.background='linear-gradient(to right, #6A994E, #A7C957)'">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Créer la première recette
                            </a>
                        @endauth
                    </div>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
