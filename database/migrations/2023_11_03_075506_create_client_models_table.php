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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate();

            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('email')->unique();
            $table->string('birthdate');
            $table->string('tin')->unique();
            $table->string('address');
            $table->string('phone')->unique();

            $table->enum('gender', \App\Enums\User\UserGenderEnum::values());
            $table->decimal('salary');

            $table->softDeletes();
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