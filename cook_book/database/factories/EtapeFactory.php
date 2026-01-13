<?php

namespace Database\Factories;

use App\Models\Etape;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etape>
 */
class EtapeFactory extends Factory
{
    protected $model = Etape::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $etapes = [
            'Préchauffez le four à 180°C (thermostat 6).',
            'Lavez soigneusement les légumes et coupez-les en morceaux réguliers.',
            'Dans une grande poêle ou une sauteuse, faites chauffer l\'huile d\'olive à feu moyen.',
            'Ajoutez les oignons émincés et faites-les revenir jusqu\'à ce qu\'ils deviennent translucides et légèrement dorés.',
            'Incorporez délicatement tous les ingrédients et mélangez avec une spatule en bois.',
            'Laissez mijoter à feu doux pendant environ 20 minutes en remuant de temps en temps.',
            'Assaisonnez généreusement avec du sel et du poivre fraîchement moulu selon votre goût.',
            'Servez bien chaud dans des assiettes préchauffées avec une garniture de votre choix.',
            'Laissez refroidir complètement à température ambiante avant de déguster.',
            'Décorez élégamment avec des herbes fraîches ciselées juste avant de servir.',
            'Mélangez tous les ingrédients secs dans un grand saladier jusqu\'à obtenir une texture homogène.',
            'Versez délicatement le mélange dans un moule préalablement beurré et fariné.',
            'Enfournez au centre du four et laissez cuire pendant environ 30 minutes.',
            'Vérifiez la cuisson en plantant la pointe d\'un couteau au centre : il doit ressortir propre.',
            'Laissez reposer 10 minutes dans le moule avant de démouler sur une grille.',
            'Faites revenir la viande de tous les côtés dans une cocotte jusqu\'à ce qu\'elle soit bien colorée.',
            'Ajoutez les légumes et laissez cuire à couvert pendant 45 minutes en remuant régulièrement.',
            'Déglaisez le fond de la poêle avec un peu de vin ou de bouillon pour récupérer tous les sucs.',
            'Réservez au frais pendant au moins 2 heures pour que les saveurs se développent.',
            'Fouettez énergiquement jusqu\'à obtenir une texture lisse et onctueuse.',
        ];

        return [
            'recipe_id' => Recipe::factory(),
            'numero_etape' => 1,
            'description' => fake()->randomElement($etapes),
        ];
    }
}
