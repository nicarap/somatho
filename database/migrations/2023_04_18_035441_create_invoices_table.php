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
            $table->string('id');
            $table->uuid('traitment_id');

            $table->dateTime('realized_at');
            $table->dateTime('paid_at');

            $table->string('therapist_address');
            $table->string('therapist_complement_address')->nullable();
            $table->string('therapist_postal_code');
            $table->string('therapist_location');

            $table->string('patient_address');
            $table->string('patient_complement_address')->nullable();
            $table->string('patient_postal_code');
            $table->string('patient_location');
            
            $table->string('tva');

            $table->timestamps();
            
            $table->foreign('traitment_id')->references('id')->on('traitments');

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices_has_traitments');
        Schema::dropIfExists('invoice');
    }
};
