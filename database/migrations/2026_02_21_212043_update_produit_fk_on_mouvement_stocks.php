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
        Schema::table('mouvement_stocks', function (Blueprint $table) {
            $table->dropForeign(['produit_id']);

            $table->foreign('produit_id')
                ->references('id')
                ->on('produits')
                ->restrictOnDelete();
        });
    }

    public function down()
    {
        Schema::table('mouvement_stocks', function (Blueprint $table) {
            $table->dropForeign(['produit_id']);

            $table->foreign('produit_id')
                ->references('id')
                ->on('produits')
                ->cascadeOnDelete();
        });
    }
};
