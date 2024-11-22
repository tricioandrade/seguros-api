<?php

namespace App\Models\Client\Vehicle;

use App\Models\User\UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehiclePhotosModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vehicle_photos';

    /**
     * The attributes that should be mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'path',
        'description'
    ];

    /**
     * The relationship tha belongs to Users.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    /**
     * The relationship tha belongs to Vehicles.
     *
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_id');
    }
}
