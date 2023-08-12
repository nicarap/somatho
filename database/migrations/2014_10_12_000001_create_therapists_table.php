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

        Schema::create('therapists_has_patients', function (Blueprint $table) {
            $table->uuid('therapist_id');
            $table->uuid('user_id');

            $table->foreign('therapist_id')->references('id')->on('therapists');
            $table->foreign('user_id')->references('id')->on('users');
            $table->primary(['therapist_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('therapists_has_patients');
        Schema::dropIfExists('therapists');
    }
};
