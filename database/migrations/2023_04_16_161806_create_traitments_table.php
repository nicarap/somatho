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
            $table->uuid('address_id');
            $table->timestamp('programmed_start_at');
            $table->timestamp('programmed_end_at');
            $table->timestamp('therapist_validated_at')->nullable();
            $table->timestamp('patient_validated_at')->nullable();
            $table->timestamp('realized_at')->nullable();
            $table->string("info_realized")->nullable();
            $table->float('price');
            $table->unsignedBigInteger("discount_id")->nullable();
            $table->float('travel_cost')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('therapist_id')->references('id')->on('therapists');
            $table->foreign('patient_id')->references('id')->on('users');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('discount_id')->references('id')->on('discounts');
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
