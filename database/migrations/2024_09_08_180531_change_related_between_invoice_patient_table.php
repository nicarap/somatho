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
        Schema::table('invoices', function (Blueprint $table) {
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();
            $table->dropColumn('traitment_id');

            $table->uuid('therapist_id');
            $table->foreign("therapist_id")->references("id")->on("therapists");

            $table->uuid('patient_id');
            $table->foreign("patient_id")->references("id")->on("users");
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id')->nullable();

            $table->foreign("invoice_id")->references("id")->on("invoices");
        });

        Schema::table('traitments', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id')->nullable();

            $table->foreign("invoice_id")->references("id")->on("invoices");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('traitments', function (Blueprint $table) {
            $table->dropColumn('invoice_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('invoice_id');
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('start_at');
            $table->dropColumn('end_at');
            $table->dropColumn('therapist_id');
            $table->dropColumn('patient_id');

            $table->uuid('traitment_id')->nullable();
            $table->foreign("traitment_id")->references("id")->on("traitments");
        });
    }
};
