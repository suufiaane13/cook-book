<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">
                Mes favoris
            </h2>
            <p class="text-gray-600 mt-1">{{ $recipes->total() ?? 0 }} recette{{ ($recipes->total() ?? 0) > 1 ? 's' : '' }} favorite{{ ($recipes->total() ?? 0) > 1 ? 's' : '' }}</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-16 text-center">
                        <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-red-50 mb-6">
                            <svg class="h-12 w-12 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">
                            Aucun favori pour le moment
                        </h3>
                        <p class="text-gray-500 mb-8 max-w-md mx-auto">
                            Vous n'avez pas encore ajouté de recettes à vos favoris. Explorez notre collection et sauvegardez vos recettes préférées !
                        </p>
                        <a href="{{ route('recettes.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                            Découvrir des recettes
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
