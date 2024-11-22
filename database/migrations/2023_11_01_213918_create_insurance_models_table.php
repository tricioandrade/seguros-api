<?php

use App\Enums\Insurance\Vehicle\FractionationTypesEnum;
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
        Schema::create('insurance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate();

            $table->string('description');

            /**
             * Travel insurance
             */
            $table->string('destiny')->nullable();
            $table->integer('duration')->nullable();
            $table->decimal('value')->nullable();

            /**
             * Vehicle insurance
             */
            $table->string('vehicle_category')->nullable();
            $table->string('cylinder_capacity')->nullable();

            /**
             * Work Accident insurance
             */
            $table->integer('employees')->nullable();
            $table->string('eac')->nullable(); // Economic Activity Code
            $table->decimal('salary')->nullable();

            $table->enum('type', \App\Enums\Insurance\InsuranceTypesEnum::values());
            $table->enum('fractionation', FractionationTypesEnum::values());

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance');
    }
};
