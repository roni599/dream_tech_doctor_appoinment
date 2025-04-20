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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('hospital_name')->nullable();
            $table->string('reg_number')->nullable();
            $table->string('establish')->nullable();
            $table->string('country')->nullable();
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_district')->nullable();
            $table->text('location_details')->nullable();
            $table->string('mobile_number_1')->nullable();
            $table->string('mobile_number_2')->nullable();
            $table->string('email')->nullable();
            $table->string('admin_name')->nullable();
            $table->string('admin_mobile')->nullable();
            $table->string('admin_email')->nullable();
            $table->string('password')->nullable();
            $table->string('logo')->nullable();
            $table->string('front_picture')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
