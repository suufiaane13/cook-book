<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $recipe->titre }}
                </h2>
                <p class="text-gray-600 mt-1">Par {{ $recipe->user->name }}</p>
            </div>
            @auth
                @if(auth()->id() === $recipe->user_id)
                    <div class="flex gap-3">
                        <a href="{{ route('recettes.edit', $recipe) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            Modifier
                        </a>
                        <form action="{{ route('recettes.destroy', $recipe) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-red-600 to-red-700 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                                Supprimer
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Image -->
                <div>
                    @if($recipe->image)
                        <img src="{{ Storage::url($recipe->image) }}" alt="{{ $recipe->titre }}" class="w-full max-h-[500px] object-cover rounded-xl shadow-lg">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center rounded-xl text-gray-400 shadow-lg">
                            <svg class="w-20 h-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Informations -->
                <div>
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">
                            {{ $recipe->titre }}
                        </h1>
                        <p class="text-gray-600 text-base leading-relaxed mb-6">
                            {{ $recipe->description }}
                        </p>
                    </div>

                    <div class="flex gap-4 mb-6 flex-wrap">
                        <div class="p-5 bg-gradient-to-br from-indigo-50 to-blue-50 rounded-xl flex-1 min-w-[150px] border border-indigo-100 shadow-sm">
                            <div class="text-sm text-gray-600 mb-2 font-medium">Temps de préparation</div>
                            <div class="text-3xl font-bold text-indigo-600">{{ $recipe->temps_preparation }} min</div>
                        </div>
                        <div class="p-5 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl flex-1 min-w-[150px] border border-purple-100 shadow-sm">
                            <div class="text-sm text-gray-600 mb-2 font-medium">Nombre de personnes</div>
                            <div class="text-3xl font-bold text-purple-600">{{ $recipe->nb_personnes }}</div>
                        </div>
                    </div>

                    <div class="flex gap-2 mb-6 flex-wrap">
                        <span class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-lg font-semibold shadow-sm">
                            {{ $recipe->categorie->label() }}
                        </span>
                        <span class="px-4 py-2 bg-amber-100 text-amber-700 rounded-lg font-semibold shadow-sm">
                            {{ $recipe->difficulte->label() }}
                        </span>
                    </div>

                    @auth
                        <form action="{{ $isFavorite ? route('favoris.destroy', $recipe) : route('favoris.store', $recipe) }}" method="POST" class="inline w-full">
                            @csrf
                            @if($isFavorite)
                                @method('DELETE')
                            @endif
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg transition-all duration-200 transform hover:scale-105 {{ $isFavorite ? 'bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 focus:ring-red-500' : 'bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 focus:ring-indigo-500' }} focus:outline-none focus:ring-2 focus:ring-offset-2">
                                {{ $isFavorite ? '❤️ Retirer des favoris' : '🤍 Ajouter aux favoris' }}
                            </button>
                        </form>
                    @endauth
                </div>
            </div>

            <!-- Ingrédients -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 border border-gray-100">
                <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-indigo-50/30 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Ingrédients
                    </h2>
                </div>
                <div class="p-6">
                    <ul class="list-none p-0 space-y-3">
                        @foreach($recipe->ingredients as $ingredient)
                            <li class="py-3 px-4 border-b border-gray-100 last:border-0 flex justify-between items-center hover:bg-indigo-50/30 rounded-lg transition-colors">
                                <span class="font-semibold text-gray-900">{{ $ingredient->nom }}</span>
                                <span class="text-gray-600 font-medium">
                                    {{ $ingredient->quantite }}
                                    @if($ingredient->unite)
                                        {{ $ingredient->unite }}
                                    @endif
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Étapes -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
                <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-indigo-50/30 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        Étapes de préparation
                    </h2>
                </div>
                <div class="p-6">
                    <ol class="list-none p-0 space-y-4">
                        @foreach($recipe->etapes->sortBy('numero_etape') as $etape)
                            <li class="py-4 px-4 border-b border-gray-100 last:border-0 flex gap-4 hover:bg-indigo-50/30 rounded-lg transition-colors">
                                <span class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-indigo-600 to-indigo-700 text-white rounded-full flex items-center justify-center font-bold text-lg shadow-md">
                                    {{ $etape->numero_etape }}
                                </span>
                                <span class="flex-1 text-gray-700 leading-relaxed pt-1">
                                    {{ $etape->description }}
                                </span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
