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
            $table->string('label');
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

        Schema::create('user_has_addresses', function (Blueprint $table) {
            $table->id('id');
            $table->uuid('model_id');
            $table->string('model_type');
            $table->uuid('address_id');
            $table->boolean('default')->default(false);
            
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->unique([
                'model_id',
                'model_type',
                'address_id',
            ]);
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_has_addresses');
        Schema::dropIfExists('addresses');
    }
};
