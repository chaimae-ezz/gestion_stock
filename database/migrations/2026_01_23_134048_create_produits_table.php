<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 50)->unique();
            $table->string('designation', 200);
            $table->text('description')->nullable();
            $table->decimal('prix', 10, 2);
            $table->integer('quantite_stock')->default(0);
            $table->integer('seuil_alerte')->default(10);
            // Clés étrangères
            $table->foreignId('fournisseur_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            // Index
            $table->index('reference');
            $table->index('fournisseur_id');
            $table->index('seuil_alerte');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
