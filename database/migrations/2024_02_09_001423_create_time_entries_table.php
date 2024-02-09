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
        Schema::create("time_entries", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->text("description")->nullable();
            $table->string("category")->nullable();
            $table->unsignedInteger("time_in_minutes")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("time_entries");
    }
};
