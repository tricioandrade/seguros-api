<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'company';

    protected $fillable = [
        'name',
        'nif',
        'address',
        'door',
        'phone',
        'email',
    ];
}
