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
        Schema::create('trotp', function (Blueprint $table) {
            $table->id('otpid');
            $table->string('otp');
            $table->unsignedBigInteger('userid');
            $table->boolean('isactive')->default(0);
            $table->dateTime('createddate')->nullable();
            $table->string('createdby')->nullable();
            $table->dateTime('updateddate')->nullable();
            $table->string('updatedby')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trotp');
    }
};
