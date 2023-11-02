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
        Schema::create('accident_work_insurance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate();

            $table->integer('employees');
            $table->string('eac'); // Economic Activity Code
            $table->decimal('salary');
            $table->enum('fractionation', FractionationTypesEnum::values());
            $table->decimal('value');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accident_work_insurance');
    }
};
