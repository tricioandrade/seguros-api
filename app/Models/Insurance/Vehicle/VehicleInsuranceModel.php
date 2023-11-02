<?php

namespace App\Models\Insurance\Vehicle;

use App\Enums\Insurance\Vehicle\FractionationTypesEnum;
use App\Models\Users\UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleInsuranceModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that is table name.
     *
     * @var string
     */
    protected $table = 'vehicle_insurance';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'category',
        'cylinder_capacity',
        'fractionation',
        'value',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'fractionation'  => FractionationTypesEnum::class
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
