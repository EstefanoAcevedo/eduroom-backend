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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id('enrollment_id');
            $table->year('enrollment_academic_year');
            $table->boolean('enrollment_is_approved')->default(false);
            $table->foreignId('user_id')->references('user_id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->references('subject_id')->on('subjects')->constrained()->onDelete('cascade');
            $table->foreignId('commission_id')->references('commission_id')->on('commissions')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
