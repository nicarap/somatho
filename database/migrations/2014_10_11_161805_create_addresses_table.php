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
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('street');
            $table->string('context')->nullable();
            $table->string('postcode');
            $table->string('city');
            $table->float('longitude')->nullable();
            $table->float('latitude')->nullable();
            $table->boolean('is_verified')->default(false);

            $table->primary('id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
