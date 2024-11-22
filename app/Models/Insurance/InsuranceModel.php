<?php

namespace App\Models\Insurance;

use App\Enums\Insurance\InsuranceTypesEnum;
use App\Enums\Insurance\Vehicle\FractionationTypesEnum;
use App\Models\User\UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsuranceModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attribute that is table name.
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
        'description',
        'destiny',
        'duration',
        'value',
        'vehicle_category',
        'cylinder_capacity',
        'employees',
        'eac',
        'salary',
        'type',
        'fractionation',
        'value'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'type'          => InsuranceTypesEnum::class,
        'fractionation' => FractionationTypesEnum::class
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
     * The relationship that has many on Policies
     *
     * @return HasMany
     */
    public function policy(): HasMany
    {
        return $this->hasMany(PoliciesModel::class, 'insurance_id');
    }
}
