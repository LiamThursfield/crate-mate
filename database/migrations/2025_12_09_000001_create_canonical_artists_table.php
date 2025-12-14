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
        Schema::create('canonical_artists', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);

            $table->foreignId('user_id')->constrained();

            $table->dateTime('verified_at')->nullable()->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canonical_artists');
    }
};
