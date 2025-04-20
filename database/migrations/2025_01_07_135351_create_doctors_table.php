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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('doctor_id')->unique()->nullable();
            $table->string('deparment_category')->nullable();
            $table->string('regnum')->nullable();
            $table->string('doctorName')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('details')->nullable();
            $table->string('experience')->nullable();
            $table->json('Specialist')->nullable();
            $table->json('Shedule')->nullable();
            $table->json('symptom')->nullable();
            $table->string('mobile')->nullable();
            $table->string('mobile_optional')->nullable();
            $table->string('visitfee')->nullable();
            $table->string('second_day')->nullable();
            $table->string('second_dayFee')->nullable();
            $table->string('thired_day')->nullable();
            $table->string('thired_dayFee')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('room_number')->nullable();
            $table->string('appoinment_mobile')->nullable();
            $table->string('appoinment_mobileOptional')->nullable();
            $table->string('doctor_image')->nullable();
            $table->string('signature_image')->nullable();
            $table->string('prescription_signature_style')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
