<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('I_F')->nullable();
            $table->string('R_C')->nullable();
            $table->string('I_C_E')->nullable();
            $table->string('C_N_S_S')->nullable();
            $table->string('C_I_N')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('C_I_N_image')->nullable();
            $table->float('credit_limit')->nullable();
            $table->float('total_due_amount')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
