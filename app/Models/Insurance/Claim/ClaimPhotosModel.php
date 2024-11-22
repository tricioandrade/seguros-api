<?php

namespace App\Models\Insurance\Claim;

use App\Models\Insurance\ClaimsModel;
use App\Models\User\UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimPhotosModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes tha should be table name.
     *
     * @var string
     */
    protected $table = 'claim_photos';

    /**
     * The attributes that should be mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'claim_id',
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
     * The relationship tha belongs to Claims.
     *
     * @return BelongsTo
     */
    public function claim(): BelongsTo
    {
        return $this->belongsTo(ClaimsModel::class, 'claim_id');
    }
}
