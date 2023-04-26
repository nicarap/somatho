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
        Schema::create('therapist_infos', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->string('siren');
            $table->string('address');
            $table->string('complement_address')->nullable();
            $table->string('postal_code');
            $table->string('location');
            $table->string('tel')->nullable();

            $table->timestamps();
            $table->primary('id');
            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('therapist_infos');
    }
};
