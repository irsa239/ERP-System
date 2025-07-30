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
       Schema::create('feedbacks', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('employee_id');
    $table->string('month');
    $table->integer('year');
    $table->text('comment')->nullable();
    $table->tinyInteger('rating')->nullable();  // 1–5
    $table->text('remarks')->nullable();
    $table->string('status')->default('pending'); // e.g. approved/rejected/pending
    $table->date('date')->nullable(); // optional
    $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
