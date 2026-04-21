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
        Schema::create('billboards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group');
            $table->tinyText('name');
            $table->tinyText('slug');
            $table->text('description')->nullable();
            $table->text('remark')->nullable();
            $table->foreignId('zone_id')->constrained();
            $table->json('coordinates');
            $table->tinyText('filename');
            $table->unsignedTinyInteger('width')->default(1);
            $table->unsignedTinyInteger('height')->default(1);
            $table->tinyInteger('score')->default(0);
            $table->foreignId('contributor_id')->constrained();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billboards');
    }
};
