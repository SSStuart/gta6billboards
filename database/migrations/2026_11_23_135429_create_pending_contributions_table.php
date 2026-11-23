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
        Schema::create('pending_contributions', function (Blueprint $table) {
            $table->id();
            $table->tinyText('username');
            $table->json('coordinates')->nullable();
            $table->text('comment')->nullable();
            $table->tinyText('filename');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_contributions');
    }
};
