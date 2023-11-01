<?php

namespace App\Models\Users;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\User\UserGenderEnum;
use App\Enums\User\UserStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'name',
        'photo',
        'email',
        'birthdate',
        'tin',
        'address',
        'phone',
        'gender',
        'status',
        'hire_date',
        'salary',
        'login_times',
        'is_admin',
        'is_blocked',
        'is_employee',
        'is_client',
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
        'gender'            => UserGenderEnum::class,
        'status'            => UserStatusEnum::class,
        'salary'            => 'decimal',
        'login_times'       => 'integer',
        'is_admin'          => 'boolean',
        'is_blocked'        => 'boolean',
        'is_employee'       => 'boolean',
        'is_client'         => 'boolean',
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];
}
