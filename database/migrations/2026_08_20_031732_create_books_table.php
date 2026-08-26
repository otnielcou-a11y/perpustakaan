<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('publisher')->default('SMKN 2 Press');
            $table->year('year')->default(2024);
            $table->integer('pages')->default(250);
            $table->string('isbn')->unique();
            $table->string('category');
            $table->integer('stock_total')->default(10);
            $table->integer('stock_available')->default(10);
            $table->text('description')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
