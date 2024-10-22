<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseModel extends Model
{
    use HasFactory;
    protected $table = 'warehouses';

    protected $fillable = [
        'name',
        'address',
        'is_active',
        'created_by',
        'updated_by',
        'staff_id',
    ];

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
