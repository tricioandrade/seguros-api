<?php

namespace App\Models\Insurance\Accident;

use App\Enums\Insurance\Vehicle\FractionationTypesEnum;
use App\Models\Users\UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccidentWorkInsuranceModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that is table name.
     *
     * @var string
     */
    protected $table = 'accident_work_insurance';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'employees',
        'eac',  // Economic Activity Code
        'salary',
        'value'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'fractionation'  => FractionationTypesEnum::class,
        'salary'  => 'decimal'
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
