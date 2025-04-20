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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('Sl_no')->nullable();
            $table->string('patient_mobile')->nullable();
            $table->string('visit_date')->nullable(); 
            $table->string('patient_name')->nullable();
            $table->string('patient_address')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('visit_time')->nullable();
            $table->string('payment_status')->nullable();
            $table->text('description')->nullable();
            $table->decimal('fee', 10, 2)->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->decimal('taka', 10, 2)->nullable();
            $table->text('discount_narration')->nullable();
            $table->text('free_narration')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('reference_id')->nullable()->constrained('references')->onDelete('set null');
            $table->foreignId('discount_free_reference_id')->nullable()->constrained('references')->onDelete('set null');
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');
            $table->string('appointby')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->unique(['visit_date', 'Sl_no']);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
