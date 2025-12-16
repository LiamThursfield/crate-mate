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
        Schema::create('library_artists', function (Blueprint $table) {
            $table->id();

            $table->foreignId('canonical_artist_id')->constrained();

            $table->string('name', 255);

            $table->foreignId('library_id')->constrained();
            $table->string('source_artist_id', 255);

            $table->timestamps();

            // Ensure that each library can only have a single record for the given source artist id
            $table->unique(['library_id', 'source_artist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_artists');
    }
};
