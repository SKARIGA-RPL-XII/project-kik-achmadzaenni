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
        Schema::create('pending_registrations', function (Blueprint $table) {
            $table->id('pendingid');
            $table->string('usernm');
            $table->string('email')->unique();
            $table->string('pswd');
            $table->string('otp')->nullable();
            $table->boolean('isactive')->default(1);
            $table->dateTime('createddate')->nullable();
            $table->string('createdby')->nullable();
            $table->dateTime('updateddate')->nullable();
            $table->string('updatedby')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_registrations');
    }
};
