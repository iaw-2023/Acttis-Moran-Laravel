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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('base_price');

            //Foreign Key´s
            $table->foreignId('zone_id')->nullable()->constrained('zones');
            $table->foreignId('matchgame_id')->nullable()->constrained('matchgames');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
