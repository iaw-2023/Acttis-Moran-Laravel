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
            $table->date('played_on_date');
            $table->time('played_on_time');

             //Foreign Key´s
             $table->foreignId('teams_playing_match_id')->default()->constrained('teams_playing_matches');
             $table->foreignId('stadium_id')->default()->constrained('stadiums');
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
