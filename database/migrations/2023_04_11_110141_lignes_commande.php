<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lignesCommande', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('commande_id')->nullable();
            $table->bigInteger('quantity');
            $table->foreign('product_id')
                ->references('id')->on('products')->onDelete('cascade');
            $table->foreign('commande_id')
                ->references('id')->on('commandes')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lignesCommande');
    }
};
