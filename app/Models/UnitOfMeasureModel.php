<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitOfMeasureModel extends Model
{
    use HasFactory;
    protected $table = 'unit_of_measures';
    protected $fillable = [
        'name', 
        'symbol',
        'description',
        'is_active',
        'created_by',
        'updated_by'
    ];
}
