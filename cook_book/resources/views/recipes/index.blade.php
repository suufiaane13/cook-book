<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">
                    @if(request('search'))
                        Résultats de recherche pour "{{ request('search') }}"
                    @elseif(isset($category))
                        Recettes - {{ ucfirst($category) }}
                    @elseif(auth()->check() && !request('all'))
                        Mes recettes
                    @else
                        Toutes les recettes
                    @endif
                </h2>
                <p class="text-gray-600 mt-1">{{ $recipes->total() ?? 0 }} recette{{ ($recipes->total() ?? 0) > 1 ? 's' : '' }} trouvée{{ ($recipes->total() ?? 0) > 1 ? 's' : '' }}</p>
            </div>
            @auth
                <a href="{{ route('recettes.create') }}" class="inline-flex items-center gap-2 px-6 py-3 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105" style="background: linear-gradient(to right, #6A994E, #A7C957);" onmouseover="this.style.background='linear-gradient(to right, #5a8840, #97b947)'" onmouseout="this.style.background='linear-gradient(to right, #6A994E, #A7C957)'">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Créer une recette
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @auth
                <!-- Filtre Mes recettes / Toutes les recettes -->
                <div class="mb-6 flex gap-3">
                    <a href="{{ route('recettes.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg font-semibold text-sm transition-all duration-200 {{ !request('all') ? 'text-white shadow-lg transform hover:scale-105' : 'bg-white text-gray-700 border-2 border-gray-200 shadow-sm hover:shadow-md' }}" style="{{ !request('all') ? 'background: linear-gradient(to right, #6A994E, #A7C957);' : '' }}" onmouseover="{{ !request('all') ? "this.style.background='linear-gradient(to right, #5a8840, #97b947)'" : "this.style.borderColor='#6A994E'; this.style.backgroundColor='#F2F2F2'" }}" onmouseout="{{ !request('all') ? "this.style.background='linear-gradient(to right, #6A994E, #A7C957)'" : "this.style.borderColor=''; this.style.backgroundColor=''" }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Mes recettes
                    </a>
                    <a href="{{ route('recettes.index', ['all' => 1]) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg font-semibold text-sm transition-all duration-200 {{ request('all') ? 'text-white shadow-lg transform hover:scale-105' : 'bg-white text-gray-700 border-2 border-gray-200 shadow-sm hover:shadow-md' }}" style="{{ request('all') ? 'background: linear-gradient(to right, #6A994E, #A7C957);' : '' }}" onmouseover="{{ request('all') ? "this.style.background='linear-gradient(to right, #5a8840, #97b947)'" : "this.style.borderColor='#6A994E'; this.style.backgroundColor='#F2F2F2'" }}" onmouseout="{{ request('all') ? "this.style.background='linear-gradient(to right, #6A994E, #A7C957)'" : "this.style.borderColor=''; this.style.backgroundColor=''" }}">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Toutes les recettes
                    </a>
                </div>
            @endauth
            
            <!-- Filtres par catégorie -->
            <div class="mb-8 flex gap-3 flex-wrap">
                @php
                    $allParam = request('all') ? ['all' => 1] : [];
                @endphp
                <a href="{{ route('recettes.index', $allParam) }}" class="inline-flex items-center px-5 py-2.5 rounded-lg font-semibold text-sm transition-all duration-200 {{ !isset($category) ? 'text-white shadow-lg transform hover:scale-105' : 'bg-white text-gray-700 border-2 border-gray-200 shadow-sm hover:shadow-md' }}" style="{{ !isset($category) ? 'background: linear-gradient(to right, #6A994E, #A7C957);' : '' }}" onmouseover="{{ !isset($category) ? "this.style.background='linear-gradient(to right, #5a8840, #97b947)'" : "this.style.borderColor='#6A994E'; this.style.backgroundColor='#F2F2F2'" }}" onmouseout="{{ !isset($category) ? "this.style.background='linear-gradient(to right, #6A994E, #A7C957)'" : "this.style.borderColor=''; this.style.backgroundColor=''" }}">
                    Toutes
                </a>
                <a href="{{ route('recettes.categorie', array_merge(['category' => 'plat'], $allParam)) }}" class="inline-flex items-center px-5 py-2.5 rounded-lg font-semibold text-sm transition-all duration-200 {{ (isset($category) && $category === 'plat') ? 'text-white shadow-lg transform hover:scale-105' : 'bg-white text-gray-700 border-2 border-gray-200 shadow-sm hover:shadow-md' }}" style="{{ (isset($category) && $category === 'plat') ? 'background: linear-gradient(to right, #6A994E, #A7C957);' : '' }}" onmouseover="{{ (isset($category) && $category === 'plat') ? "this.style.background='linear-gradient(to right, #5a8840, #97b947)'" : "this.style.borderColor='#6A994E'; this.style.backgroundColor='#F2F2F2'" }}" onmouseout="{{ (isset($category) && $category === 'plat') ? "this.style.background='linear-gradient(to right, #6A994E, #A7C957)'" : "this.style.borderColor=''; this.style.backgroundColor=''" }}">
                    Plats
                </a>
                <a href="{{ route('recettes.categorie', array_merge(['category' => 'dessert'], $allParam)) }}" class="inline-flex items-center px-5 py-2.5 rounded-lg font-semibold text-sm transition-all duration-200 {{ (isset($category) && $category === 'dessert') ? 'text-white shadow-lg transform hover:scale-105' : 'bg-white text-gray-700 border-2 border-gray-200 shadow-sm hover:shadow-md' }}" style="{{ (isset($category) && $category === 'dessert') ? 'background: linear-gradient(to right, #6A994E, #A7C957);' : '' }}" onmouseover="{{ (isset($category) && $category === 'dessert') ? "this.style.background='linear-gradient(to right, #5a8840, #97b947)'" : "this.style.borderColor='#6A994E'; this.style.backgroundColor='#F2F2F2'" }}" onmouseout="{{ (isset($category) && $category === 'dessert') ? "this.style.background='linear-gradient(to right, #6A994E, #A7C957)'" : "this.style.borderColor=''; this.style.backgroundColor=''" }}">
                    Desserts
                </a>
                <a href="{{ route('recettes.categorie', array_merge(['category' => 'boisson'], $allParam)) }}" class="inline-flex items-center px-5 py-2.5 rounded-lg font-semibold text-sm transition-all duration-200 {{ (isset($category) && $category === 'boisson') ? 'text-white shadow-lg transform hover:scale-105' : 'bg-white text-gray-700 border-2 border-gray-200 shadow-sm hover:shadow-md' }}" style="{{ (isset($category) && $category === 'boisson') ? 'background: linear-gradient(to right, #6A994E, #A7C957);' : '' }}" onmouseover="{{ (isset($category) && $category === 'boisson') ? "this.style.background='linear-gradient(to right, #5a8840, #97b947)'" : "this.style.borderColor='#6A994E'; this.style.backgroundColor='#F2F2F2'" }}" onmouseout="{{ (isset($category) && $category === 'boisson') ? "this.style.background='linear-gradient(to right, #6A994E, #A7C957)'" : "this.style.borderColor=''; this.style.backgroundColor=''" }}">
                    Boissons
                </a>
            </div>

            <!-- Liste des recettes -->
            @if($recipes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recipes as $recipe)
                        <x-recipe-card :recipe="$recipe" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    {{ $recipes->links() }}
                </div>
            @else
                <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-16 text-center">
                        <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full mb-6" style="background-color: #F2F2F2;">
                            @if(request('search'))
                                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color: #6A994E;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            @else
                                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" style="color: #6A994E;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">
                            @if(request('search'))
                                Aucun résultat trouvé
                            @else
                                Aucune recette trouvée
                            @endif
                        </h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">
                            @if(request('search'))
                                Aucune recette ne correspond à votre recherche "{{ request('search') }}". Essayez avec d'autres mots-clés ou explorez toutes les recettes.
                            @elseif(isset($category))
                                Il n'y a pas encore de recettes dans la catégorie "{{ ucfirst($category) }}". Explorez les autres catégories ou créez votre première recette !
                            @elseif(auth()->check() && !request('all'))
                                Vous n'avez pas encore créé de recette. Créez votre première recette pour commencer !
                            @else
                                Il n'y a pas encore de recettes disponibles. Soyez le premier à partager votre recette préférée !
                            @endif
                        </p>
                        @if(request('search'))
                            <a href="{{ route('recettes.index') }}" class="inline-flex items-center gap-2 px-6 py-3 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105" style="background: linear-gradient(to right, #6A994E, #A7C957);" onmouseover="this.style.background='linear-gradient(to right, #5a8840, #97b947)'" onmouseout="this.style.background='linear-gradient(to right, #6A994E, #A7C957)'">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                Voir toutes les recettes
                            </a>
                        @else
                            @auth
                                <a href="{{ route('recettes.create') }}" class="inline-flex items-center gap-2 px-6 py-3 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105" style="background: linear-gradient(to right, #6A994E, #A7C957);" onmouseover="this.style.background='linear-gradient(to right, #5a8840, #97b947)'" onmouseout="this.style.background='linear-gradient(to right, #6A994E, #A7C957)'">
                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Créer la première recette
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
