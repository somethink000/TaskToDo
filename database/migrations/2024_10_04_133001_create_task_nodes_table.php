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
        Schema::create('task_nodes', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->json('data');
            $table->boolean('done');
            $table->json('position');
            // $table->integer('posx');
            // $table->integer('posy');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_nodes');
    }
};
