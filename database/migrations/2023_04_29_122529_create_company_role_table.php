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
        Schema::create('company_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();

            $table->unique(['company_id', 'role_id']);
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('CASCADE');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_role');
    }
};
