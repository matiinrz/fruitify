<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exit', function (Blueprint $table) {
            $table->id();
            $table->string('plate')->nullable();
            $table->string('plate_image')->nullable();
            $table->unsignedBigInteger('fruit_id');
            $table->string('weight');
            $table->string('entry_date');
            $table->string('user_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('stall_id');
            $table->unsignedBigInteger('hall_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exit');
    }
};
