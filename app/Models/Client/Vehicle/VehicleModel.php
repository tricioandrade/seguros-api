<?php

namespace App\Models\Client\Vehicle;

use App\Enums\Client\Vehicle\FuelTypeEnum;
use App\Enums\Client\Vehicle\OwnershipStatusEnum;
use App\Enums\Client\Vehicle\VehicleConditionEnum;
use App\Enums\Client\Vehicle\VehicleTransmissionTypeEnum;
use App\Models\User\UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that is table name.
     *
     * @var string
     */
    protected $table = 'vehicles';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'client_id',
        'license_plate',
        'manufacturer',
        'model',
        'color',
        'cylinder_capacity',
        'vehicle_identification_number',
        'fuel_type',
        'transmission_type',
        'ownership_status',
        'vehicle_condition',
        'seating_capacity',
        'odometer_reading',
        'manufacturing_year',
        'registration_date',
        'registration_number',
        'vehicle_value'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'fuel_type'         => FuelTypeEnum::class,
        'transmission_type' => VehicleTransmissionTypeEnum::class,
        'ownership_status'  => OwnershipStatusEnum::class,
        'vehicle_condition' => VehicleConditionEnum::class
    ];

    /**
     * The relationship that belongs to User
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }
}
