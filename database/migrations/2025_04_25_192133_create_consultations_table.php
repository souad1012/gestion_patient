<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rendez_vous_id')->nullable()->constrained('rendez_vous')->onDelete('set null');
            $table->foreignId('salle_id')->constrained()->onDelete('cascade');
            $table->dateTime('heure_debut');
            $table->dateTime('heure_fin')->nullable();
            $table->string('type');
            $table->text('notes')->nullable();
            $table->string('statut')->default('en_attente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('consultations');
    }
};
