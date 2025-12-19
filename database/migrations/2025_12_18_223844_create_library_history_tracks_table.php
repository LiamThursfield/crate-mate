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
        Schema::create('library_history_tracks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('library_history_id')->constrained();
            $table->foreignId('library_track_id')->constrained();
            $table->unsignedSmallInteger('track_no');
            $table->dateTime('date');

            $table->foreignId('library_id')->constrained();
            $table->string('source_history_track_id', 255);

            $table->timestamps();

            // Ensure that each library can only have a single record for the given source / history track id
            $table->unique(['library_id', 'source_history_track_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_history_tracks');
    }
};
