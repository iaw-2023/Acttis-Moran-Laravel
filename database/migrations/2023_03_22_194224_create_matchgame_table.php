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
        Schema::create('matchgames', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('played_on');

             //Foreign Key´s
             $table->foreignId('local_team_id')->constrained('teams');
             $table->foreignId('away_team_id')->constrained('teams');
             $table->foreignId('played_in')->constrained('stadiums');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matchgames');
    }
};
