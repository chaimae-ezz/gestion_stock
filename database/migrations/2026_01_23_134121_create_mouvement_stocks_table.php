<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mouvement_stocks', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('produit_id')->constrained()->cascadeOnDelete();
            $table->foreignId('produit_id')
                ->constrained()
                ->restrictOnDelete();
            $table->enum('type_mouvement', ['entree', 'sortie', 'ajustement', 'inventaire']);
            $table->integer('quantite');
            $table->integer('quantite_avant');
            $table->integer('quantite_apres');
            $table->string('motif', 100)->nullable();
            $table->string('reference_document', 100)->nullable();
            $table->foreignId('utilisateur_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamp('date_mouvement')->useCurrent();

            $table->timestamps();

            // Index
            $table->index('produit_id');
            $table->index('type_mouvement');
            $table->index('date_mouvement');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvement_stocks');
    }
};
