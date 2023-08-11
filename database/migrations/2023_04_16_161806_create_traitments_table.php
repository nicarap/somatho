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
        Schema::create('traitments', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('therapist_id');
            $table->uuid('patient_id');
            $table->dateTime('programmed_start_at');
            $table->dateTime('programmed_end_at');
            $table->dateTime('therapist_validated_at')->nullable();
            $table->dateTime('patient_validated_at')->nullable();
            $table->dateTime('realized_at')->nullable();
            $table->float('price');
            $table->float('travel_cost')->nullable();
            $table->float('discount')->nullable();
            $table->string('location_choosed');
            $table->string('address');
            $table->string('complement_address')->nullable();
            $table->string('postal_code');
            $table->string('location');
            $table->timestamps();

            $table->foreign('therapist_id')->references('id')->on('users');
            $table->foreign('patient_id')->references('id')->on('users');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traitments');
    }
};
