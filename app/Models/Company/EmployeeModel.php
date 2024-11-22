<?php

namespace App\Models\Company;

use App\Enums\Company\Employee\EmployeeGenderEnum;
use App\Enums\Company\Employee\EmployeeStatusEnum;
use App\Models\Inventory\Product\ProductModel;
use App\Models\Sale\Invoice\InvoiceItensModel;
use App\Models\Sale\InvoiceModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class EmployeeModel extends User
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attribute that is table name.
     *
     * @var string
     */
    protected $table = 'employees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'birthdate',
        'gender',
        'status',
        'address',
        'phone',
        'hire_date',
        'salary',
        'photo',
        'email',
        'password',
        'login_times',
        'is_admin',
        'is_blocked'
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
        'status'            => EmployeeStatusEnum::class,
        'gender'            => EmployeeGenderEnum::class,
        'is_admin'          => 'boolean',
        'is_blocked'        => 'boolean',
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    /**
     * Defines Employee and product relationship
     *
     * @return HasMany
     */
    public function product(): HasMany
    {
        return $this->hasMany(ProductModel::class, 'employee_id');
    }

    /**
     * Defines Employee and invoices relationship
     *
     * @return HasMany
     */
    public function invoice(): HasMany
    {
        return $this->hasMany(InvoiceModel::class, 'employee_id');
    }

    /**
     * Defines Employee and Invoices Itens relationship
     *
     * @return HasMany
     */
    public function invoice_itens(): HasMany
    {
        return $this->hasMany(InvoiceItensModel::class, 'employee_id');
    }
}
