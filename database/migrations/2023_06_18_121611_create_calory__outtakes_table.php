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
        Schema::create('calory__outtakes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exercise_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('quantity');
            $table->decimal('total_calorie_outtake', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calory__outtakes');
    }
};
