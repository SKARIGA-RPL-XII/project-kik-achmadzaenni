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
        Schema::table('msuser', function (Blueprint $table) {
            $table->id('userid');
            $table->id('roleid')->nullable();
            $table->string('usernm')->unique();
            $table->string('email')->unique();
            $table->string('pswd');
            $table->boolean('isactive')->default(0);
            $table->dateTime('createddate')->nullable();
            $table->string('createdby')->nullable();
            $table->dateTime('updatedate')->nullable();
            $table->string('updatedby')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('msuser');
    }
};
