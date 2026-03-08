<?php

namespace Database\Factories;

use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitFactory extends Factory
{
    protected $model = Produit::class;

    public function definition(): array
    {
        return [
            'reference' => strtoupper($this->faker->unique()->bothify('PRD-###')),
            'designation' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'prix' => $this->faker->randomFloat(2, 10, 500),
            'quantite_stock' => $this->faker->numberBetween(0, 100),
            'seuil_alerte' => $this->faker->numberBetween(5, 20),
            'fournisseur_id' => Fournisseur::inRandomOrder()->first()?->id,
        ];
    }
}
