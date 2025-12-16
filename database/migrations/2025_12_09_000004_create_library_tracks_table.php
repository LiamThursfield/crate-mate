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
        Schema::create('library_tracks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('canonical_track_id')->nullable()->index();

            $table->string('title', 255);
            $table->decimal('bpm', 5, 2)->nullable();
            $table->unsignedSmallInteger('duration');
            $table->string('key', 5)->nullable();

            $table->foreignId('library_artist_id')->nullable()->constrained();

            $table->foreignId('library_id')->constrained();
            $table->string('source_track_id', 255);

            $table->timestamps();

            // Ensure that each user can only have a single record for the given source / track id
            $table->unique(['library_id', 'source_track_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_tracks');
    }
};
