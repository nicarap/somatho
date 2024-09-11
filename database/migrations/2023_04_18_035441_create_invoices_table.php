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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->uuid('traitment_id');

            $table->dateTime('paid_at')->nullable();
            $table->string("filename")->nullable();

            $table->string('therapist_street');
            $table->string('therapist_context')->nullable();
            $table->string('therapist_postcode');
            $table->string('therapist_city');

            $table->string('patient_street')->nullable();
            $table->string('patient_context')->nullable();
            $table->string('patient_postcode')->nullable();
            $table->string('patient_city')->nullable();

            $table->timestamps();

            $table->foreign('traitment_id')->references('id')->on('traitments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
