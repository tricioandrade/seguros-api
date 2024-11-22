<?php

namespace App\Models\Insurance;

use App\Enums\Insurance\Claim\ClaimStatusEnum;
use App\Models\Client\ClientModel;
use App\Models\User\UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimsModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attribute that is table name.
     *
     * @var string
     */
    protected $table = 'claims';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'client_id',
        'policy_id',
        'claim_type',
        'description',
        'claim_status',
        'claim_payment',
        'claim_report_date',
        'claim_resolution_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'claim_status'  => ClaimStatusEnum::class
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
     * The relationship that belongs to Policy
     *
     * @return BelongsTo
     */
    public function policy(): BelongsTo
    {
        return $this->belongsTo(PoliciesModel::class, 'policy_id');
    }
}
