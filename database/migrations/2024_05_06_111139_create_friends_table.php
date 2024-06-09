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
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sent_from');
            $table->foreign('sent_from')->references('id')->on('users');
            $table->unsignedBigInteger('sent_for');
            $table->foreign('sent_for')->references('id')->on('users');
            $table->enum('status', ['waiting', 'confirm', 'reject'])->default('waiting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friends');
    }
};
