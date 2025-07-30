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
        Schema::create('self_evaluations', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('employee_id');
    $table->string('month');
    $table->tinyInteger('self_rating'); // 1–5
    $table->text('challenges')->nullable();
    $table->text('goals')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('self_evaluations');
    }
};
