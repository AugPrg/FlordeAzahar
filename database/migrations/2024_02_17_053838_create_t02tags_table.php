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
        Schema::create('t03tag', function (Blueprint $table) {
            $table->id('t03id');
            $table->string('t03nombre');
            $table->string('t03tipo');
            $table->unsignedBigInteger('t03usuario');
            $table->foreign('t03usuario')->references('sys01id')->on('sys01usuarios');
            $table->timestamps();
            $table->string('t03slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t02tags');
    }
};
