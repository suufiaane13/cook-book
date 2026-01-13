<?php

namespace Database\Seeders;

use App\Enums\CategoryEnum;
use App\Enums\DifficultyEnum;
use App\Models\Etape;
use App\Models\Favorite;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Supprimer toutes les recettes existantes et leurs relations
        $this->command->info('🗑️  Suppression des recettes existantes...');
        
        // Désactiver temporairement les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        Favorite::truncate();
        Etape::truncate();
        Ingredient::truncate();
        Recipe::truncate();
        
        // Réactiver les contraintes de clé étrangère
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $marocainNames = [
            'Ahmed Alami',
            'Fatima Benali',
            'Mohamed Amrani',
            'Aicha El Fassi',
            'Youssef Alaoui',
            'Sanae Bensaid',
            'Hassan Idrissi',
            'Nadia Tazi',
        ];

        // Créer un utilisateur de test avec un nom marocain
        $testUser = User::firstOrCreate(
            ['email' => 'x'],
            [
                'name' => 'Ahmed Alami',
                'password' => bcrypt('password'),
            ]
        );

        // Créer 2 utilisateurs supplémentaires avec des noms marocains
        $users = [];
        $usedNames = ['Ahmed Alami'];
        for ($i = 0; $i < 2; $i++) {
            $availableNames = array_diff($marocainNames, $usedNames);
            $randomName = $availableNames[array_rand($availableNames)];
            $usedNames[] = $randomName;
            
            // Générer un email à partir du nom
            $nameParts = explode(' ', $randomName);
            $firstName = strtolower($nameParts[0]);
            $lastName = strtolower($nameParts[1] ?? '');
            $email = $firstName . '.' . $lastName . '@example.com';
            
            $users[] = User::create([
                'name' => $randomName,
                'email' => $email,
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }
        
        $allUsers = collect([$testUser])->merge($users);

        // Préparer le dossier de destination pour les images
        $targetImagesPath = storage_path('app/public/recipes');
        if (!File::exists($targetImagesPath)) {
            File::makeDirectory($targetImagesPath, 0755, true);
        }

        // Source des images
        $sourceImagesPath = base_path('images');

        // Définir les recettes avec leurs données
        $recipesData = [
            [
                'titre' => 'Tajine de poulet aux légumes',
                'description' => 'Un plat traditionnel marocain savoureux et réconfortant, parfait pour un repas en famille. Cette recette combine harmonieusement le poulet avec des légumes frais et des épices authentiques.',
                'categorie' => 'plat',
                'difficulte' => 'moyen',
                'temps_preparation' => 60,
                'nb_personnes' => 4,
                'image' => 'Tajine de poulet aux légumes.jpg',
                'ingredients' => [
                    ['nom' => 'Poulet', 'quantite' => '1 kg', 'unite' => ''],
                    ['nom' => 'Pommes de terre', 'quantite' => '3', 'unite' => ''],
                    ['nom' => 'Carottes', 'quantite' => '3', 'unite' => ''],
                    ['nom' => 'Oignon', 'quantite' => '1', 'unite' => ''],
                    ['nom' => 'Ail', 'quantite' => '2', 'unite' => 'gousses'],
                    ['nom' => 'Huile d\'olive', 'quantite' => '3', 'unite' => 'cuillères'],
                    ['nom' => 'Curcuma', 'quantite' => '1', 'unite' => 'cuillère'],
                    ['nom' => 'Gingembre', 'quantite' => '1', 'unite' => 'cuillère'],
                    ['nom' => 'Sel et poivre', 'quantite' => 'selon goût', 'unite' => ''],
                ],
                'etapes' => [
                    ['numero_etape' => 1, 'description' => 'Nettoyer et couper le poulet.'],
                    ['numero_etape' => 2, 'description' => 'Éplucher et couper les légumes.'],
                    ['numero_etape' => 3, 'description' => 'Faire revenir l\'oignon et l\'ail dans l\'huile.'],
                    ['numero_etape' => 4, 'description' => 'Ajouter le poulet et les épices.'],
                    ['numero_etape' => 5, 'description' => 'Mélanger et laisser dorer.'],
                    ['numero_etape' => 6, 'description' => 'Ajouter les légumes.'],
                    ['numero_etape' => 7, 'description' => 'Verser un verre d\'eau.'],
                    ['numero_etape' => 8, 'description' => 'Couvrir et laisser mijoter 40 minutes.'],
                    ['numero_etape' => 9, 'description' => 'Vérifier la cuisson et servir chaud.'],
                ],
            ],
            [
                'titre' => 'Spaghetti à la sauce bolognaise',
                'description' => 'Un classique italien qui ravira toute la famille. Des pâtes al dente accompagnées d\'une sauce bolognaise riche et savoureuse.',
                'categorie' => 'plat',
                'difficulte' => 'facile',
                'temps_preparation' => 45,
                'nb_personnes' => 4,
                'image' => 'Spaghetti à la sauce bolognaise.jfif',
                'ingredients' => [
                    ['nom' => 'Spaghetti', 'quantite' => '400', 'unite' => 'g'],
                    ['nom' => 'Viande hachée', 'quantite' => '300', 'unite' => 'g'],
                    ['nom' => 'Tomates', 'quantite' => '4', 'unite' => ''],
                    ['nom' => 'Oignon', 'quantite' => '1', 'unite' => ''],
                    ['nom' => 'Ail', 'quantite' => '2', 'unite' => 'gousses'],
                    ['nom' => 'Huile d\'olive', 'quantite' => '2', 'unite' => 'cuillères'],
                    ['nom' => 'Sel', 'quantite' => 'selon goût', 'unite' => ''],
                    ['nom' => 'Poivre', 'quantite' => 'selon goût', 'unite' => ''],
                    ['nom' => 'Origan', 'quantite' => 'selon goût', 'unite' => ''],
                ],
                'etapes' => [
                    ['numero_etape' => 1, 'description' => 'Faire bouillir l\'eau pour les pâtes.'],
                    ['numero_etape' => 2, 'description' => 'Cuire les spaghetti.'],
                    ['numero_etape' => 3, 'description' => 'Faire revenir l\'oignon et l\'ail.'],
                    ['numero_etape' => 4, 'description' => 'Ajouter la viande hachée.'],
                    ['numero_etape' => 5, 'description' => 'Ajouter les tomates écrasées.'],
                    ['numero_etape' => 6, 'description' => 'Assaisonner.'],
                    ['numero_etape' => 7, 'description' => 'Laisser mijoter 20 minutes.'],
                    ['numero_etape' => 8, 'description' => 'Égoutter les pâtes.'],
                    ['numero_etape' => 9, 'description' => 'Mélanger avec la sauce.'],
                    ['numero_etape' => 10, 'description' => 'Servir chaud.'],
                ],
            ],
            [
                'titre' => 'Riz sauté aux légumes',
                'description' => 'Un plat asiatique simple et délicieux, parfait pour un repas rapide et équilibré. Le riz sauté aux légumes est un classique qui se prépare en un rien de temps.',
                'categorie' => 'plat',
                'difficulte' => 'facile',
                'temps_preparation' => 30,
                'nb_personnes' => 3,
                'image' => 'Riz sauté aux légumes.jpeg',
                'ingredients' => [
                    ['nom' => 'Riz', 'quantite' => '300', 'unite' => 'g'],
                    ['nom' => 'Carottes', 'quantite' => '2', 'unite' => ''],
                    ['nom' => 'Petit pois', 'quantite' => '100', 'unite' => 'g'],
                    ['nom' => 'Œufs', 'quantite' => '2', 'unite' => ''],
                    ['nom' => 'Sauce soja', 'quantite' => '2', 'unite' => 'cuillères'],
                    ['nom' => 'Huile', 'quantite' => '2', 'unite' => 'cuillères'],
                    ['nom' => 'Oignon', 'quantite' => '1', 'unite' => ''],
                    ['nom' => 'Sel', 'quantite' => 'selon goût', 'unite' => ''],
                ],
                'etapes' => [
                    ['numero_etape' => 1, 'description' => 'Cuire le riz.'],
                    ['numero_etape' => 2, 'description' => 'Couper les légumes.'],
                    ['numero_etape' => 3, 'description' => 'Faire chauffer l\'huile.'],
                    ['numero_etape' => 4, 'description' => 'Ajouter l\'oignon.'],
                    ['numero_etape' => 5, 'description' => 'Ajouter les légumes.'],
                    ['numero_etape' => 6, 'description' => 'Battre les œufs et les ajouter.'],
                    ['numero_etape' => 7, 'description' => 'Ajouter le riz.'],
                    ['numero_etape' => 8, 'description' => 'Verser la sauce soja.'],
                    ['numero_etape' => 9, 'description' => 'Mélanger et servir.'],
                ],
            ],
            [
                'titre' => 'Gâteau au chocolat',
                'description' => 'Un dessert irrésistible pour les amateurs de chocolat. Ce gâteau moelleux et fondant fera le bonheur de toute la famille.',
                'categorie' => 'dessert',
                'difficulte' => 'moyen',
                'temps_preparation' => 50,
                'nb_personnes' => 6,
                'image' => 'Gâteau au chocolat.webp',
                'ingredients' => [
                    ['nom' => 'Chocolat noir', 'quantite' => '200', 'unite' => 'g'],
                    ['nom' => 'Farine', 'quantite' => '150', 'unite' => 'g'],
                    ['nom' => 'Sucre', 'quantite' => '150', 'unite' => 'g'],
                    ['nom' => 'Beurre', 'quantite' => '100', 'unite' => 'g'],
                    ['nom' => 'Œufs', 'quantite' => '3', 'unite' => ''],
                    ['nom' => 'Levure chimique', 'quantite' => '1', 'unite' => 'sachet'],
                    ['nom' => 'Vanille', 'quantite' => 'quelques gouttes', 'unite' => ''],
                ],
                'etapes' => [
                    ['numero_etape' => 1, 'description' => 'Préchauffer le four.'],
                    ['numero_etape' => 2, 'description' => 'Faire fondre le chocolat et le beurre.'],
                    ['numero_etape' => 3, 'description' => 'Mélanger sucre et œufs.'],
                    ['numero_etape' => 4, 'description' => 'Ajouter le chocolat fondu.'],
                    ['numero_etape' => 5, 'description' => 'Ajouter farine et levure.'],
                    ['numero_etape' => 6, 'description' => 'Mélanger.'],
                    ['numero_etape' => 7, 'description' => 'Verser dans un moule.'],
                    ['numero_etape' => 8, 'description' => 'Cuire 30 minutes.'],
                    ['numero_etape' => 9, 'description' => 'Laisser refroidir.'],
                ],
            ],
            [
                'titre' => 'Crêpes maison',
                'description' => 'Des crêpes légères et délicieuses, parfaites pour le petit-déjeuner ou le goûter. Une recette simple et rapide à réaliser.',
                'categorie' => 'dessert',
                'difficulte' => 'facile',
                'temps_preparation' => 25,
                'nb_personnes' => 4,
                'image' => 'Crêpes maison.webp',
                'ingredients' => [
                    ['nom' => 'Farine', 'quantite' => '250', 'unite' => 'g'],
                    ['nom' => 'Lait', 'quantite' => '500', 'unite' => 'ml'],
                    ['nom' => 'Œufs', 'quantite' => '3', 'unite' => ''],
                    ['nom' => 'Sucre', 'quantite' => '2', 'unite' => 'cuillères'],
                    ['nom' => 'Beurre fondu', 'quantite' => '50', 'unite' => 'g'],
                    ['nom' => 'Sel', 'quantite' => 'une pincée', 'unite' => ''],
                ],
                'etapes' => [
                    ['numero_etape' => 1, 'description' => 'Mélanger farine et sel.'],
                    ['numero_etape' => 2, 'description' => 'Ajouter les œufs.'],
                    ['numero_etape' => 3, 'description' => 'Verser le lait progressivement.'],
                    ['numero_etape' => 4, 'description' => 'Ajouter le sucre.'],
                    ['numero_etape' => 5, 'description' => 'Ajouter le beurre.'],
                    ['numero_etape' => 6, 'description' => 'Mélanger jusqu\'à obtenir une pâte lisse.'],
                    ['numero_etape' => 7, 'description' => 'Chauffer la poêle.'],
                    ['numero_etape' => 8, 'description' => 'Cuire chaque crêpe.'],
                    ['numero_etape' => 9, 'description' => 'Servir.'],
                ],
            ],
            [
                'titre' => 'Salade de fruits frais',
                'description' => 'Une salade de fruits rafraîchissante et colorée, parfaite pour terminer un repas ou pour une collation saine. Un mélange de saveurs sucrées et acidulées.',
                'categorie' => 'dessert',
                'difficulte' => 'facile',
                'temps_preparation' => 15,
                'nb_personnes' => 3,
                'image' => 'Salade de fruits frais.jpg',
                'ingredients' => [
                    ['nom' => 'Pomme', 'quantite' => '1', 'unite' => ''],
                    ['nom' => 'Banane', 'quantite' => '1', 'unite' => ''],
                    ['nom' => 'Orange', 'quantite' => '1', 'unite' => ''],
                    ['nom' => 'Fraise', 'quantite' => '150', 'unite' => 'g'],
                    ['nom' => 'Jus de citron', 'quantite' => 'quelques gouttes', 'unite' => ''],
                    ['nom' => 'Miel', 'quantite' => 'selon goût', 'unite' => ''],
                    ['nom' => 'Menthe', 'quantite' => 'quelques feuilles', 'unite' => ''],
                ],
                'etapes' => [
                    ['numero_etape' => 1, 'description' => 'Laver les fruits.'],
                    ['numero_etape' => 2, 'description' => 'Éplucher et couper.'],
                    ['numero_etape' => 3, 'description' => 'Mettre dans un bol.'],
                    ['numero_etape' => 4, 'description' => 'Ajouter le jus de citron.'],
                    ['numero_etape' => 5, 'description' => 'Ajouter le miel.'],
                    ['numero_etape' => 6, 'description' => 'Mélanger.'],
                    ['numero_etape' => 7, 'description' => 'Décorer avec menthe.'],
                    ['numero_etape' => 8, 'description' => 'Servir frais.'],
                ],
            ],
            [
                'titre' => 'Jus d\'orange frais',
                'description' => 'Un jus d\'orange fraîchement pressé, plein de vitamines et de fraîcheur. Idéal pour commencer la journée du bon pied.',
                'categorie' => 'boisson',
                'difficulte' => 'facile',
                'temps_preparation' => 10,
                'nb_personnes' => 2,
                'image' => 'Jus d\'orange frais.webp',
                'ingredients' => [
                    ['nom' => 'Oranges', 'quantite' => '4', 'unite' => ''],
                    ['nom' => 'Sucre', 'quantite' => 'optionnel', 'unite' => ''],
                    ['nom' => 'Eau fraîche', 'quantite' => 'un peu', 'unite' => ''],
                    ['nom' => 'Glaçons', 'quantite' => 'selon goût', 'unite' => ''],
                ],
                'etapes' => [
                    ['numero_etape' => 1, 'description' => 'Laver les oranges.'],
                    ['numero_etape' => 2, 'description' => 'Les couper.'],
                    ['numero_etape' => 3, 'description' => 'Presser le jus.'],
                    ['numero_etape' => 4, 'description' => 'Ajouter un peu d\'eau.'],
                    ['numero_etape' => 5, 'description' => 'Ajouter le sucre si besoin.'],
                    ['numero_etape' => 6, 'description' => 'Mélanger.'],
                    ['numero_etape' => 7, 'description' => 'Ajouter les glaçons.'],
                    ['numero_etape' => 8, 'description' => 'Servir frais.'],
                ],
            ],
            [
                'titre' => 'Thé à la menthe marocain',
                'description' => 'Un thé traditionnel marocain, rafraîchissant et parfumé. Un moment de convivialité à partager avec vos proches.',
                'categorie' => 'boisson',
                'difficulte' => 'facile',
                'temps_preparation' => 15,
                'nb_personnes' => 4,
                'image' => 'Thé à la menthe marocain.jfif',
                'ingredients' => [
                    ['nom' => 'Thé vert', 'quantite' => '2', 'unite' => 'cuillères'],
                    ['nom' => 'Menthe fraîche', 'quantite' => 'quelques branches', 'unite' => ''],
                    ['nom' => 'Sucre', 'quantite' => 'selon goût', 'unite' => ''],
                    ['nom' => 'Eau', 'quantite' => '500', 'unite' => 'ml'],
                ],
                'etapes' => [
                    ['numero_etape' => 1, 'description' => 'Faire bouillir l\'eau.'],
                    ['numero_etape' => 2, 'description' => 'Rincer le thé.'],
                    ['numero_etape' => 3, 'description' => 'Ajouter l\'eau chaude.'],
                    ['numero_etape' => 4, 'description' => 'Ajouter le sucre.'],
                    ['numero_etape' => 5, 'description' => 'Ajouter la menthe.'],
                    ['numero_etape' => 6, 'description' => 'Laisser infuser.'],
                    ['numero_etape' => 7, 'description' => 'Mélanger.'],
                    ['numero_etape' => 8, 'description' => 'Servir chaud.'],
                ],
            ],
            [
                'titre' => 'Smoothie banane-fraise',
                'description' => 'Un smoothie onctueux et fruité, parfait pour un petit-déjeuner équilibré ou une collation saine. Un mélange délicieux de banane et de fraises.',
                'categorie' => 'boisson',
                'difficulte' => 'facile',
                'temps_preparation' => 10,
                'nb_personnes' => 2,
                'image' => 'Smoothie banane-fraise.webp',
                'ingredients' => [
                    ['nom' => 'Banane', 'quantite' => '1', 'unite' => ''],
                    ['nom' => 'Fraise', 'quantite' => '150', 'unite' => 'g'],
                    ['nom' => 'Lait', 'quantite' => '250', 'unite' => 'ml'],
                    ['nom' => 'Miel', 'quantite' => 'selon goût', 'unite' => ''],
                    ['nom' => 'Glaçons', 'quantite' => 'quelques', 'unite' => ''],
                ],
                'etapes' => [
                    ['numero_etape' => 1, 'description' => 'Laver les fraises.'],
                    ['numero_etape' => 2, 'description' => 'Éplucher la banane.'],
                    ['numero_etape' => 3, 'description' => 'Mettre les fruits dans le mixeur.'],
                    ['numero_etape' => 4, 'description' => 'Ajouter le lait.'],
                    ['numero_etape' => 5, 'description' => 'Ajouter le miel.'],
                    ['numero_etape' => 6, 'description' => 'Mixer.'],
                    ['numero_etape' => 7, 'description' => 'Ajouter les glaçons.'],
                    ['numero_etape' => 8, 'description' => 'Servir frais.'],
                ],
            ],
        ];

        // Créer les recettes
        foreach ($recipesData as $index => $recipeData) {
            // Copier l'image si elle existe
            $imagePath = null;
            $sourceImage = $sourceImagesPath . DIRECTORY_SEPARATOR . $recipeData['image'];
            
            // Essayer de trouver le fichier même si le nom ne correspond pas exactement
            if (!File::exists($sourceImage)) {
                // Lister tous les fichiers du dossier pour trouver une correspondance
                $allFiles = File::files($sourceImagesPath);
                $imageName = $recipeData['image'];
                foreach ($allFiles as $file) {
                    $fileName = $file->getFilename();
                    // Comparer en ignorant les différences d'apostrophes et de casse
                    $normalizedFileName = str_replace(['\'', '’', '"'], '', strtolower($fileName));
                    $normalizedImageName = str_replace(['\'', '’', '"'], '', strtolower($imageName));
                    if ($normalizedFileName === $normalizedImageName || 
                        str_contains(strtolower($fileName), strtolower(str_replace(['\'', '’'], '', $imageName)))) {
                        $sourceImage = $file->getPathname();
                        $recipeData['image'] = $fileName; // Mettre à jour le nom pour la copie
                        break;
                    }
                }
            }
            
            if (File::exists($sourceImage)) {
                $targetImage = $targetImagesPath . DIRECTORY_SEPARATOR . $recipeData['image'];
                File::copy($sourceImage, $targetImage);
                $imagePath = 'recipes/' . $recipeData['image'];
                $this->command->info('📸 Image copiée: ' . $recipeData['image']);
            } else {
                $this->command->warn('⚠️  Image non trouvée: ' . $recipeData['image']);
            }

            // Assigner un utilisateur aléatoire
            $user = $allUsers->random();

            // Créer la recette
            $recipe = Recipe::create([
                'user_id' => $user->id,
                'titre' => $recipeData['titre'],
                'description' => $recipeData['description'],
                'image' => $imagePath,
                'temps_preparation' => $recipeData['temps_preparation'],
                'nb_personnes' => $recipeData['nb_personnes'],
                'categorie' => CategoryEnum::from($recipeData['categorie']),
                'difficulte' => DifficultyEnum::from($recipeData['difficulte']),
            ]);

            // Créer les ingrédients
            foreach ($recipeData['ingredients'] as $ingredientData) {
                Ingredient::create([
                    'recipe_id' => $recipe->id,
                    'nom' => $ingredientData['nom'],
                    'quantite' => $ingredientData['quantite'],
                    'unite' => $ingredientData['unite'] ?? '',
                ]);
            }

            // Créer les étapes
            foreach ($recipeData['etapes'] as $etapeData) {
                Etape::create([
                    'recipe_id' => $recipe->id,
                    'numero_etape' => $etapeData['numero_etape'],
                    'description' => $etapeData['description'],
                ]);
            }
        }

        // Créer des favoris : chaque utilisateur ajoute 2-3 recettes en favoris
        $recipes = Recipe::all();
        
        $allUsers->each(function ($user) use ($recipes) {
            // Exclure les recettes de l'utilisateur lui-même
            $otherRecipes = $recipes->where('user_id', '!=', $user->id);
            
            if ($otherRecipes->count() > 0) {
                // Sélectionner 2-3 recettes aléatoires
                $favoriteRecipes = $otherRecipes->random(rand(2, min(3, $otherRecipes->count())));
                
                // Créer les favoris
                $favoriteRecipes->each(function ($recipe) use ($user) {
                    Favorite::create([
                        'user_id' => $user->id,
                        'recipe_id' => $recipe->id,
                    ]);
                });
            }
        });

        $this->command->info('✅ ' . User::count() . ' utilisateurs');
        $this->command->info('✅ ' . Recipe::count() . ' recettes créées');
        $this->command->info('✅ ' . Ingredient::count() . ' ingrédients créés');
        $this->command->info('✅ ' . Etape::count() . ' étapes créées');
        $this->command->info('✅ ' . Favorite::count() . ' favoris créés');
        $this->command->info('');
        $this->command->info('🔑 Connexion de test :');
        $this->command->info('   Email: ahmed.alami@example.com');
        $this->command->info('   Password: password');
    }
}
