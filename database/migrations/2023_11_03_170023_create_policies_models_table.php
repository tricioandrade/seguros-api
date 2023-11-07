<?php

use App\Enums\Insurance\Policie\PoliceStatusEnum;
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
        Schema::create('policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate();

            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnUpdate();

            $table->foreignId('vehicle_id')
                ->constrained('vehicles')
                ->cascadeOnUpdate();

            $table->foreignId('insurance_id')
                ->constrained('insurance')
                ->cascadeOnUpdate();

            $table->string('policy_number');
            $table->string('issue_date');
            $table->string('expiration_date');

            $table->enum('status', PoliceStatusEnum::values());

            $table->string('policy_holder');
            $table->string('renewal_date');
            $table->string('policy_terms');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
