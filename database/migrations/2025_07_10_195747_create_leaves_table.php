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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            // Foreign key: which employee is requesting the leave
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            // Type of leave (e.g. sick, casual, emergency etc.)
            $table->string('leave_type');

            // From - To date range
            $table->date('from_date');
            $table->date('to_date');

            // Reason for leave
            $table->text('reason');

            // Status: pending / approved / rejected
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
