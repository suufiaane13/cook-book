<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">
                Modifier la recette
            </h2>
            <p class="text-gray-600 mt-1">{{ $recipe->titre }}</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('recettes.update', $recipe) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 border border-gray-100">
                    <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-indigo-50/30 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Informations générales
                        </h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <x-input-label for="titre" value="Titre de la recette *" />
                            <x-text-input id="titre" name="titre" type="text" class="block mt-1 w-full" :value="old('titre', $recipe->titre)" required autofocus />
                            <x-input-error :messages="$errors->get('titre')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Description *" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('description', $recipe->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="image" value="Image" />
                            @if($recipe->image)
                                <div class="mb-4">
                                    <img src="{{ Storage::url($recipe->image) }}" alt="Image actuelle" class="max-w-xs max-h-xs rounded-lg">
                                    <p class="text-sm text-gray-600 mt-2">Image actuelle</p>
                                </div>
                            @endif
                            <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            <div id="image-preview" class="mt-4 hidden">
                                <img id="preview-img" src="" alt="Aperçu" class="max-w-xs max-h-xs rounded-lg">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="temps_preparation" value="Temps de préparation (minutes) *" />
                                <x-text-input id="temps_preparation" name="temps_preparation" type="number" min="1" class="block mt-1 w-full" :value="old('temps_preparation', $recipe->temps_preparation)" required />
                                <x-input-error :messages="$errors->get('temps_preparation')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="nb_personnes" value="Nombre de personnes *" />
                                <x-text-input id="nb_personnes" name="nb_personnes" type="number" min="1" class="block mt-1 w-full" :value="old('nb_personnes', $recipe->nb_personnes)" required />
                                <x-input-error :messages="$errors->get('nb_personnes')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="categorie" value="Catégorie *" />
                                <select id="categorie" name="categorie" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Sélectionner une catégorie</option>
                                    <option value="plat" {{ old('categorie', $recipe->categorie->value) === 'plat' ? 'selected' : '' }}>Plat</option>
                                    <option value="dessert" {{ old('categorie', $recipe->categorie->value) === 'dessert' ? 'selected' : '' }}>Dessert</option>
                                    <option value="boisson" {{ old('categorie', $recipe->categorie->value) === 'boisson' ? 'selected' : '' }}>Boisson</option>
                                </select>
                                <x-input-error :messages="$errors->get('categorie')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="difficulte" value="Difficulté *" />
                                <select id="difficulte" name="difficulte" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">Sélectionner une difficulté</option>
                                    <option value="facile" {{ old('difficulte', $recipe->difficulte->value) === 'facile' ? 'selected' : '' }}>Facile</option>
                                    <option value="moyen" {{ old('difficulte', $recipe->difficulte->value) === 'moyen' ? 'selected' : '' }}>Moyen</option>
                                    <option value="difficile" {{ old('difficulte', $recipe->difficulte->value) === 'difficile' ? 'selected' : '' }}>Difficile</option>
                                </select>
                                <x-input-error :messages="$errors->get('difficulte')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ingrédients -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 border border-gray-100">
                    <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-indigo-50/30 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Ingrédients (maximum 10) *
                        </h3>
                        <button type="button" id="add-ingredient" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Ajouter
                        </button>
                    </div>
                    <div class="p-6">
                        <div id="ingredients-container" class="space-y-4">
                            @php
                                $oldIngredients = old('ingredients', $recipe->ingredients->map(function($ing) {
                                    return ['nom' => $ing->nom, 'quantite' => $ing->quantite, 'unite' => $ing->unite];
                                })->toArray());
                            @endphp
                            @foreach($oldIngredients as $index => $ingredient)
                                <div class="ingredient-item grid grid-cols-[2fr_1fr_1fr_auto] gap-4 items-end">
                                    <div>
                                        <x-input-label :value="'Nom de l\'ingrédient'" />
                                        <x-text-input name="ingredients[{{ $index }}][nom]" type="text" class="block mt-1 w-full" :value="$ingredient['nom'] ?? ''" required />
                                    </div>
                                    <div>
                                        <x-input-label value="Quantité" />
                                        <x-text-input name="ingredients[{{ $index }}][quantite]" type="text" class="block mt-1 w-full" :value="$ingredient['quantite'] ?? ''" required />
                                    </div>
                                    <div>
                                        <x-input-label value="Unité" />
                                        <x-text-input name="ingredients[{{ $index }}][unite]" type="text" class="block mt-1 w-full" :value="$ingredient['unite'] ?? ''" />
                                    </div>
                                    <div>
                                        <button type="button" class="remove-ingredient inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">×</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('ingredients')" class="mt-2" />
                    </div>
                </div>

                <!-- Étapes -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 border border-gray-100">
                    <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-indigo-50/30 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                            Étapes de préparation *
                        </h3>
                        <button type="button" id="add-etape" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-600 to-indigo-700 border border-transparent rounded-lg font-semibold text-sm text-white shadow-lg hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Ajouter
                        </button>
                    </div>
                    <div class="p-6">
                        <div id="etapes-container" class="space-y-4">
                            @php
                                $oldEtapes = old('etapes', $recipe->etapes->sortBy('numero_etape')->map(function($etape) {
                                    return ['numero_etape' => $etape->numero_etape, 'description' => $etape->description];
                                })->values()->toArray());
                            @endphp
                            @foreach($oldEtapes as $index => $etape)
                                <div class="etape-item grid grid-cols-[auto_1fr_auto] gap-4 items-start">
                                    <div class="w-12">
                                        <x-input-label value="N°" />
                                        <x-text-input name="etapes[{{ $index }}][numero_etape]" type="number" min="1" class="block mt-1 w-full" :value="$etape['numero_etape'] ?? $index + 1" required />
                                    </div>
                                    <div>
                                        <x-input-label value="Description" />
                                        <textarea name="etapes[{{ $index }}][description]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required>{{ $etape['description'] ?? '' }}</textarea>
                                    </div>
                                    <div>
                                        <button type="button" class="remove-etape mt-7 inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">×</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('etapes')" class="mt-2" />
                    </div>
                </div>

                <div class="flex gap-4 justify-end pt-6 border-t border-gray-200">
                    <a href="{{ route('recettes.show', $recipe) }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-gray-300 rounded-lg font-semibold text-sm text-gray-700 shadow-sm hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200">
                        Annuler
                    </a>
                    <x-primary-button>
                        Mettre à jour la recette
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image preview
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        // Gestion des ingrédients
        let ingredientIndex = {{ count($oldIngredients) }};
        document.getElementById('add-ingredient').addEventListener('click', function() {
            if (document.querySelectorAll('.ingredient-item').length >= 10) {
                alert('Maximum 10 ingrédients autorisés');
                return;
            }
            const container = document.getElementById('ingredients-container');
            const newItem = document.createElement('div');
            newItem.className = 'ingredient-item grid grid-cols-[2fr_1fr_1fr_auto] gap-4 items-end';
            newItem.innerHTML = `
                <div>
                    <label class="block font-medium text-sm text-gray-700">Nom de l'ingrédient</label>
                    <input type="text" name="ingredients[${ingredientIndex}][nom]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Quantité</label>
                    <input type="text" name="ingredients[${ingredientIndex}][quantite]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Unité</label>
                    <input type="text" name="ingredients[${ingredientIndex}][unite]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>
                <div>
                    <button type="button" class="remove-ingredient inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">×</button>
                </div>
            `;
            container.appendChild(newItem);
            ingredientIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-ingredient')) {
                if (document.querySelectorAll('.ingredient-item').length > 1) {
                    e.target.closest('.ingredient-item').remove();
                } else {
                    alert('Au moins un ingrédient est requis');
                }
            }
        });

        // Gestion des étapes
        let etapeIndex = {{ count($oldEtapes) }};
        document.getElementById('add-etape').addEventListener('click', function() {
            const container = document.getElementById('etapes-container');
            const newItem = document.createElement('div');
            newItem.className = 'etape-item grid grid-cols-[auto_1fr_auto] gap-4 items-start';
            newItem.innerHTML = `
                <div class="w-12">
                    <label class="block font-medium text-sm text-gray-700">N°</label>
                    <input type="number" name="etapes[${etapeIndex}][numero_etape]" min="1" value="${etapeIndex + 1}" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Description</label>
                    <textarea name="etapes[${etapeIndex}][description]" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3" required></textarea>
                </div>
                <div>
                    <button type="button" class="remove-etape mt-7 inline-flex items-center px-3 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">×</button>
                </div>
            `;
            container.appendChild(newItem);
            etapeIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-etape')) {
                if (document.querySelectorAll('.etape-item').length > 1) {
                    e.target.closest('.etape-item').remove();
                } else {
                    alert('Au moins une étape est requise');
                }
            }
        });
    </script>
</x-app-layout>
