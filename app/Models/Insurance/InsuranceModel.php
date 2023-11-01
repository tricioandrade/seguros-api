<?php

namespace App\Models\Insurance;

use App\Enums\Insurance\InsuranceTypesEnum;
use App\Models\Users\UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsuranceModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that is table name.
     *
     * @var string
     */
    protected $table = 'insurance';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'type',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'type'  => InsuranceTypesEnum::class
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
