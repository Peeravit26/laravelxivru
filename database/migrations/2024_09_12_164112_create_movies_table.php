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
            
            $table->integer('category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('actor')->nullable();
            $table->float('price')->nullable();
            $table->integer('special')->nullable();
            $table->integer('common_id')->nullable();
            $table->integer('sold')->nullable();
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
