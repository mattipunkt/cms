<?php

use App\Models\Location;
use App\Models\Movie;
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
        Schema::create('showtimes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Movie::class, 'movie_id')->onDelete('cascade');
            $table->foreignIdFor(Location::class)->onDelete('cascade');
            $table->dateTime('time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('showtimes');
    }
};
