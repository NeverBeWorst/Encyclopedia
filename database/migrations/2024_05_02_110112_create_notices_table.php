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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sent_from');
            $table->foreign('sent_from')->references('id')->on('users');
            $table->unsignedBigInteger('sent_for');
            $table->foreign('sent_for')->references('id')->on('users');
            $table->text('text');
            $table->enum('action', ['notice', 'congratulations' , 'warning', 'ban']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
