@props(['recipe'])

<div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-200/50 group">
    <!-- Image Section -->
    <div class="relative overflow-hidden">
        @if($recipe->image)
            <a href="{{ route('recettes.show', $recipe) }}" class="block">
                <img src="{{ Storage::url($recipe->image) }}" alt="{{ $recipe->titre }}" class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
            </a>
        @else
            <div class="w-full h-56 flex items-center justify-center" style="background: linear-gradient(to bottom right, #F2F2F2, rgba(167, 201, 87, 0.2));">
                <svg class="w-20 h-20" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #6A994E; opacity: 0.5;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
        
        <!-- Badge Catégorie sur l'image -->
        <div class="absolute top-4 left-4">
            <span class="px-3 py-1.5 rounded-full text-xs font-bold shadow-lg backdrop-blur-sm" style="background-color: rgba(242, 242, 242, 0.95); color: #6A994E;">
                {{ $recipe->categorie->label() }}
            </span>
        </div>
        
        <!-- Badge Difficulté sur l'image -->
        <div class="absolute top-4 right-4">
            <span class="px-3 py-1.5 rounded-full text-xs font-bold shadow-lg backdrop-blur-sm" style="background-color: rgba(242, 242, 242, 0.95); color: #8D6E63;">
                {{ $recipe->difficulte->label() }}
            </span>
        </div>
    </div>

    <!-- Content Section -->
    <div class="p-6">
        <!-- Titre -->
        <h3 class="text-xl font-bold mb-3 group/title">
            <a href="{{ route('recettes.show', $recipe) }}" class="text-gray-900 transition-colors duration-200 line-clamp-2" style="color: inherit;" onmouseover="this.style.color='#6A994E'" onmouseout="this.style.color=''">
                {{ $recipe->titre }}
            </a>
        </h3>
        
        <!-- Description -->
        <p class="text-gray-600 text-sm mb-5 line-clamp-2 leading-relaxed min-h-[2.5rem]">
            {{ Str::limit($recipe->description, 100) }}
        </p>

        <!-- Informations (Temps et Personnes) -->
        <div class="flex gap-4 mb-5 pb-5 border-b border-gray-100">
            <div class="flex items-center gap-2 text-sm">
                <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background-color: #F2F2F2;">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #6A994E;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-medium">Temps</div>
                    <div class="font-bold" style="color: #6A994E;">{{ $recipe->temps_preparation }} min</div>
                </div>
            </div>
            <div class="flex items-center gap-2 text-sm">
                <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background-color: #F2F2F2;">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #A7C957;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-xs text-gray-500 font-medium">Personnes</div>
                    <div class="font-bold" style="color: #A7C957;">{{ $recipe->nb_personnes }}</div>
                </div>
            </div>
        </div>

        <!-- Footer avec Auteur et Favori -->
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-2">
                @auth
                    @if(auth()->id() === $recipe->user_id)
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-md" style="background: linear-gradient(to bottom right, #6A994E, #A7C957);">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm font-semibold" style="color: #6A994E;">Ma Recette</div>
                        </div>
                    @else
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-md" style="background: linear-gradient(to bottom right, #6A994E, #A7C957);">
                            {{ strtoupper(substr($recipe->user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="text-xs text-gray-500 font-medium">Par</div>
                            <div class="text-sm font-semibold" style="color: #6A994E;">{{ $recipe->user->name }}</div>
                        </div>
                    @endif
                @else
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-xs shadow-md" style="background: linear-gradient(to bottom right, #6A994E, #A7C957);">
                        {{ strtoupper(substr($recipe->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="text-xs text-gray-500 font-medium">Par</div>
                        <div class="text-sm font-semibold" style="color: #6A994E;">{{ $recipe->user->name }}</div>
                    </div>
                @endauth
            </div>
            
            @auth
                @php
                    $isFavorite = auth()->user()->favoriteRecipes()->where('recipe_id', $recipe->id)->exists();
                @endphp
                <form action="{{ $isFavorite ? route('favoris.destroy', $recipe) : route('favoris.store', $recipe) }}" method="POST" class="inline">
                    @csrf
                    @if($isFavorite)
                        @method('DELETE')
                    @endif
                    <button type="submit" class="w-10 h-10 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-offset-2" style="background-color: #F2F2F2; --tw-ring-color: #8D6E63;" onmouseover="this.style.backgroundColor='rgba(141, 110, 99, 0.1)'" onmouseout="this.style.backgroundColor='#F2F2F2'">
                        <span class="text-xl">{{ $isFavorite ? '❤️' : '🤍' }}</span>
                    </button>
                </form>
            @endauth
        </div>
    </div>
</div>
