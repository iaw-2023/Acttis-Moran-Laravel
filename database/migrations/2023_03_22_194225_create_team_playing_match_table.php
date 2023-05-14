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
        Schema::create('teams_playing_matchs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('condition');

            $table->softDeletes();

            //Foreign Key´s
            $table->foreignId('team_id')->default()->constrained('teams');
            $table->foreignId('matchgame_id')->default()->constrained('matchgames');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams_playing_matchs');
    }
};
