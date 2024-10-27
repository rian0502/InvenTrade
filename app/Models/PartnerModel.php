<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerModel extends Model
{
    use HasFactory;
    protected $table = 'partners';
    protected $fillable = [
        'code',
        'name',
        'npwp',
        'description',
        'address',
        'phone',
        'email',
        'contact_person',
        'is_supplier',
        'is_active',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
