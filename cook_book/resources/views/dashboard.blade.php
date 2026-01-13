<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">
                    Tableau de bord
        </h2>
                <p class="text-gray-600 mt-1">Bienvenue, {{ auth()->user()->name }} !</p>
            </div>
            <a href="{{ route('recettes.create') }}" class="inline-flex items-center gap-2 px-6 py-3 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105" style="background: linear-gradient(to right, #6A994E, #A7C957);" onmouseover="this.style.background='linear-gradient(to right, #5a8840, #97b947)'" onmouseout="this.style.background='linear-gradient(to right, #6A994E, #A7C957)'">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Créer une recette
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <!-- Carte Mes Recettes -->
                <a href="{{ route('recettes.index') }}" class="group block bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1" onmouseover="this.style.borderColor='rgba(106, 153, 78, 0.3)'" onmouseout="this.style.borderColor=''">
                    <div class="p-5 relative overflow-hidden" style="background: linear-gradient(135deg, rgba(106, 153, 78, 0.05) 0%, rgba(167, 201, 87, 0.1) 100%);">
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 rounded-xl flex items-center justify-center shadow-md transform group-hover:scale-110 transition-transform duration-300" style="background: linear-gradient(135deg, #6A994E, #A7C957);">
                                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: inherit;" onmouseover="this.style.color='#6A994E'" onmouseout="this.style.color=''">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-4xl font-extrabold mb-1" style="color: #6A994E;">
                                    {{ auth()->user()->recipes()->count() }}
                                </div>
                                <div class="text-base font-semibold text-gray-900">Mes recettes</div>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Carte Mes Favoris -->
                <a href="{{ route('favoris.index') }}" class="group block bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1" onmouseover="this.style.borderColor='rgba(141, 110, 99, 0.3)'" onmouseout="this.style.borderColor=''">
                    <div class="p-5 relative overflow-hidden" style="background: linear-gradient(135deg, rgba(141, 110, 99, 0.05) 0%, rgba(167, 201, 87, 0.08) 100%);">
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-14 h-14 rounded-xl flex items-center justify-center shadow-md transform group-hover:scale-110 transition-transform duration-300" style="background: linear-gradient(135deg, #8D6E63, #A7C957);">
                                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: inherit;" onmouseover="this.style.color='#6A994E'" onmouseout="this.style.color=''">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-4xl font-extrabold mb-1" style="color: #8D6E63;">
                                    {{ auth()->user()->favoriteRecipes()->count() }}
                                </div>
                                <div class="text-base font-semibold text-gray-900">Mes favoris</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 border border-gray-100">
                <div class="px-5 py-4 border-b border-gray-200 flex justify-between items-center" style="background: linear-gradient(to right, #F2F2F2, rgba(106, 153, 78, 0.1));">
                    <h3 class="text-lg font-bold text-gray-900">Mes recettes</h3>
                    <a href="{{ route('recettes.index') }}" class="text-sm font-semibold transition-colors flex items-center gap-1" style="color: #6A994E;" onmouseover="this.style.color='#5a8840'" onmouseout="this.style.color='#6A994E'">
                        Voir toutes
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                <div class="p-4">
                    @php
                        $myRecipes = auth()->user()->recipes()->with(['ingredients', 'etapes'])->latest()->take(3)->get();
                    @endphp
                    @if($myRecipes->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($myRecipes as $recipe)
                                <x-recipe-card :recipe="$recipe" />
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-600">
                            <p class="mb-4">Vous n'avez pas encore créé de recette.</p>
                            <a href="{{ route('recettes.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105" style="background: linear-gradient(to right, #6A994E, #A7C957);" onmouseover="this.style.background='linear-gradient(to right, #5a8840, #97b947)'" onmouseout="this.style.background='linear-gradient(to right, #6A994E, #A7C957)'">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Créer ma première recette
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <div class="px-5 py-4 border-b border-gray-200 flex justify-between items-center" style="background: linear-gradient(to right, #F2F2F2, rgba(141, 110, 99, 0.1));">
                    <h3 class="text-lg font-bold text-gray-900">Mes favoris</h3>
                    <a href="{{ route('favoris.index') }}" class="text-sm font-semibold transition-colors flex items-center gap-1" style="color: #6A994E;" onmouseover="this.style.color='#5a8840'" onmouseout="this.style.color='#6A994E'">
                        Voir tous
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                <div class="p-4">
                    @php
                        $myFavorites = auth()->user()->favoriteRecipes()->with(['user', 'ingredients', 'etapes'])->latest()->take(3)->get();
                    @endphp
                    @if($myFavorites->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($myFavorites as $recipe)
                                <x-recipe-card :recipe="$recipe" />
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-600">
                            <p class="mb-4">Vous n'avez pas encore de recettes favorites.</p>
                            <a href="{{ route('recettes.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105" style="background: linear-gradient(to right, #6A994E, #A7C957);" onmouseover="this.style.background='linear-gradient(to right, #5a8840, #97b947)'" onmouseout="this.style.background='linear-gradient(to right, #6A994E, #A7C957)'">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                                Découvrir des recettes
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
