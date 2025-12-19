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
        Schema::create('library_histories', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->datetime('date')->index();

            $table->boolean('include_in_stats')->index();

            $table->foreignId('library_id')->constrained();
            $table->string('source_history_id', 255);

            $table->timestamps();

            // Ensure that each library can only have a single record for the given source / history id
            $table->unique(['library_id', 'source_history_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_histories');
    }
};
