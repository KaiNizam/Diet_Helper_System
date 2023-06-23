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
        Schema::create('calory_intakes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('quantity');
            $table->string('meal');
            $table->decimal('breakfast_calorie_intake', 8, 2)->default(0);
            $table->decimal('lunch_calorie_intake', 8, 2)->default(0);
            $table->decimal('dinner_calorie_intake', 8, 2)->default(0);
            $table->decimal('snack_calorie_intake', 8, 2)->default(0);
            $table->decimal('total_calorie_intake', 8, 2)->default(0);
            $table->timestamps();

            $table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('calory_intakes');
    }
};
