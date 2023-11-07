<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\User\UserGenderEnum;
use App\Enums\User\UserStatusEnum;
use App\Models\Client\Vehicle\VehicleModel;
use App\Models\Employee\EmployeeModel;
use App\Models\Insurance\Claim\ClaimPhotosModel;
use App\Models\Insurance\ClaimsModel;
use App\Models\Insurance\InsuranceModel;
use App\Models\Insurance\PoliciesModel;
use App\Models\Insurance\Travel\TravelDestinationModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attribute that is table name.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'login_times',
        'is_admin',
        'is_blocked',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'login_times'       => 'integer',
        'is_admin'          => 'boolean',
        'is_blocked'        => 'boolean',
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /**
     * The relationship tha belongs to Employees
     *
     * @return HasMany
     */
    public function employee(): HasMany
    {
        return $this->hasMany(EmployeeModel::class, 'user_id');
    }
    /**
     * The relationship tha belongs to Insurance
     *
     * @return HasMany
     */
    public function insurance(): HasMany
    {
        return $this->hasMany(InsuranceModel::class, 'user_id');
    }
    /**
     * The relationship tha belongs to Policies
     *
     * @return HasMany
     */
    public function policy(): HasMany
    {
        return $this->hasMany(PoliciesModel::class, 'user_id');
    }
    /**
     * The relationship tha belongs to Claims
     *
     * @return HasMany
     */
    public function claim(): HasMany
    {
        return $this->hasMany(ClaimsModel::class, 'user_id');
    }
    /**
     * The relationship tha belongs to Claim Photos
     *
     * @return HasMany
     */
    public function claim_photos(): HasMany
    {
        return $this->hasMany(ClaimPhotosModel::class, 'user_id');
    }

    /**
     * The relationship tha belongs to Travel Destination
     *
     * @return HasMany
     */
    public function travel_destination(): HasMany
    {
        return $this->hasMany(TravelDestinationModel::class, 'user_id');
    }

    /**
     * The relationship tha belongs to
     *
     * @return HasMany
     */
    public function vehicle(): HasMany
    {
        return $this->hasMany(VehicleModel::class, 'user_id');
    }
}
