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
        Schema::create('subfolders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constained('users');
            $table->string('file_location');
            $table->string('file_path');
            $table->string('remarks')->nullable();
            $table->integer('permission');
            $table->boolean('is_sharable')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subfolders');
    }
};
