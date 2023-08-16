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
        Schema::create('bookingtbs', function (Blueprint $table) {
            $table->id();
            $table->integer("packagetype");
            $table->string("washingpoint");
            $table->string("fname");
            $table->string("contactno");
            $table->string("washdate");
            $table->string("washtime");
            $table->string("message");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookingtbs');
    }
};
