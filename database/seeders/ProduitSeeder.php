<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produit;
class ProduitSeeder extends Seeder
{
    public function run(): void
    {
        Produit::factory()->count(30)->create();
    }
}
