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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('bookId', 36)->unique();
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('genre')->nullable();
            $table->string('publisher')->nullable();
            $table->text('description')->nullable();
            $table->decimal('rating', 5, 1)->nullable();
            $table->date('year')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
