<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fournisseur;
class FournisseurSeeder extends Seeder
{

    public function run(): void
    {
        Fournisseur::factory()->count(20)->create();
    }
}
