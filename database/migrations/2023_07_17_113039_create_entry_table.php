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
        Schema::create('entry', function (Blueprint $table) {
            $table->id();
            $table->string('plate');
            $table->string('image')->nullable();
            $table->string('weight');
            $table->json('type');
            $table->string('entry_date');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entery');
    }
};
