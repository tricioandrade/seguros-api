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
        Schema::create('claim_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users');

            $table->foreignId('claim_id')
                ->constrained('claims');

            $table->string('path');
            $table->string('description');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claim_photos');
    }
};
