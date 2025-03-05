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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('codebarre')->unique();
            $table->string('designation');
            $table->double('prix_ht');
            $table->double('tva');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('sous_famille_id')->constrained()->onDelete('cascade');
            $table->foreignId('marque_id')->constrained()->onDelete('cascade');
            $table->foreignId('unite_id')->constrained()->onDelete('cascade');
            $table->integer('stock');
            $table->timestamps();
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
