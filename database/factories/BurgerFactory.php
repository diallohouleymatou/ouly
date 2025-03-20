<?php

namespace Database\Factories;

use App\Models\Burger;
use Illuminate\Database\Eloquent\Factories\Factory;

class BurgerFactory extends Factory
{
    protected $model = Burger::class;

    public function definition()
    {
        $categories = [
            'Burger au Fromage Téranga', // Une référence à l'hospitalité et à un goût délicieux avec du fromage
            'Burger Panini Dakar', // Un nom local qui évoque la ville de Dakar
            'Burger Brochette Youssou', // En référence à la célèbre brochette, plat populaire
            'Burger Fast Sénégalais', // Un clin d'œil à la cuisine rapide mais bien locale
            'Burger Pimenté', // Un burger épicé avec un goût bien relevé à la sénégalaise
            'Burger Royal Dakar', // Pour un burger gourmet, savoureux et de qualité
        ];


        $descriptions = [
            'Un burger garni de trois couches de fromage crémeux, pour un goût délicieux qui te fera fondre de plaisir.',
            'Un burger grillé à la panini, avec des ingrédients frais et savoureux, parfait pour un déjeuner rapide et cool.',
            'Un burger avec des brochettes de viande grillées, de la laitue croquante, le tout parfumé aux épices du barbecue.',
            'Le burger de tous les jours, avec un steak juteux, du bacon croustillant et une sauce maison bien crémeuse.',
            'Un burger piquant, avec des piments locaux, du fromage fondant et une sauce épicée qui va te réveiller les papilles !',
            'Un burger haut de gamme avec du bœuf de qualité supérieure, des légumes frais et une sauce maison, tout pour satisfaire les gourmets.',
        ];

        // Les catégories et les prix sont ajustés aux préférences sénégalaises
        $description = $this->faker->randomElement($descriptions);
        $categorie = $categories[array_search($description, $descriptions)];

        return [
            'nom' => $this->faker->randomElement([
                'Burger Cheese Dakar',
                'Burger Panini Téranga',
                'Burger Brochette Youssou',
                'Burger MC Tasty',
                'Burger Spicy Gusto',
                'Burger Royal DAK',
            ]),
            'prix' => $this->faker->numberBetween(3000, 12000), // Prix ajusté pour correspondre à la gamme du Sénégal
            'image' => 'burgers/' . $this->faker->randomElement([
                    'img.png',
                    'img_1.png',
                    'img_3.png',
                    'img_4.png',
                ]),
            'description' => $description,
            'categorie' => $categorie,
            'stock' => $this->faker->numberBetween(10, 100), // Plus de stock pour simuler une demande plus importante
        ];
    }
}
