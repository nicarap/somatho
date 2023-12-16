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
        Schema::create('therapists', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('tel')->nullable();
            $table->string('siren')->nullable();
            $table->rememberToken();

            $table->timestamps();
            $table->primary('id');
        });

        Schema::create('therapist_has_addresses', function (Blueprint $table) {
            $table->id('id');
            $table->uuid('therapist_id');
            $table->uuid('address_id');
            $table->boolean('default')->default(false);

            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('therapist_id')->references('id')->on('therapists');
            $table->unique([
                'therapist_id',
                'address_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('therapist_has_addresses');
        Schema::dropIfExists('therapists');
    }
};
