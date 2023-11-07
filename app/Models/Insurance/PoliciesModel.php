<?php

namespace App\Models\Insurance;

use App\Enums\Insurance\Policie\PoliceStatusEnum;
use App\Models\Client\ClientModel;
use App\Models\Client\Vehicle\VehicleModel;
use App\Models\User\UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PoliciesModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attribute that is table name.
     *
     * @var string
     */
    protected $table = 'policies';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'client_id',
        'vehicle_id',
        'insurance_id',
        'policy_number',
        'issue_date',
        'expiration_date',
        'status',
        'policy_holder',
        'renewal_date',
        'policy_terms',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'status'  => PoliceStatusEnum::class
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

    /**
     * The relationship that belongs to Client
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(ClientModel::class, 'client_id');
    }

    /**
     * The relationship that belongs to Claim
     *
     * @return HasMany
     */
    public function claim(): HasMany
    {
        return $this->hasMany(ClaimsModel::class, 'policy_id');
    }

    /**
     * The relationship that belongs to Vehicle
     *
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(VehicleModel::class, 'vehicle_id');
    }
}
