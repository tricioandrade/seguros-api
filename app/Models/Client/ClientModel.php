<?php

namespace App\Models\Client;

use App\Enums\User\UserGenderEnum;
use App\Models\User\UserModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientModel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that is table name.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'photo',
        'email',
        'birthdate',
        'tin',
        'address',
        'phone',
        'gender',
        'salary',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = [
        'gender' => UserGenderEnum::class,
        'salary' => 'decimal'
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
