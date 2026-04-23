<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();

            // Qui a publié cette offre ? (une société = un user)
            $table->foreignId('societe_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->string('titre');
            $table->text('description');
            $table->string('ville');
            $table->integer('duree'); // en mois
            $table->decimal('remuneration', 8, 2)->nullable(); // peut être 0
            $table->date('date_limite')->nullable();

            // active = visible, inactive = masquée par admin
            $table->enum('statut', ['active', 'inactive'])->default('active');

            $table->timestamps(); // created_at et updated_at automatiques
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offres');
    }
};