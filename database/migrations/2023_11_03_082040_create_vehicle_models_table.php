<?php

use App\Enums\Client\Vehicle\FuelTypeEnum;
use App\Enums\Client\Vehicle\OwnershipStatusEnum;
use App\Enums\Client\Vehicle\VehicleConditionEnum;
use App\Enums\Client\Vehicle\VehicleTransmissionTypeEnum;
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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate();

            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnUpdate();

            $table->string('license_plate')->unique();
            $table->string('manufacturer');
            $table->string('model');
            $table->string('color');
            $table->decimal('cylinder_capacity');
            $table->string('vehicle_identification_number')->unique();

            $table->enum('fuel_type', FuelTypeEnum::values());
            $table->enum('transmission_type', VehicleTransmissionTypeEnum::values());
            $table->enum('ownership_status', OwnershipStatusEnum::values());
            $table->enum('vehicle_condition', VehicleConditionEnum::values());

            $table->integer('seating_capacity');
            $table->integer('odometer_reading');

            $table->year('manufacturing_year');
            $table->date('registration_date');
            $table->string('registration_number')->unique();
            $table->decimal('vehicle_value');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
