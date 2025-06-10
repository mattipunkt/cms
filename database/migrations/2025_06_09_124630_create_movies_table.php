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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('year');
            $table->string('director')->nullable();
            $table->string('actors')->nullable();
            $table->string('genre')->nullable();
            $table->string('country')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('trailer_url')->nullable();
            $table->integer('runtime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
