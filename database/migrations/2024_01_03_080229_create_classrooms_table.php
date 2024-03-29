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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('room_id');
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('users');
            $table->foreign('room_id')->references('id')->on('rooms');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
