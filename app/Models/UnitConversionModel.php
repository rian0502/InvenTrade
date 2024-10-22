<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitConversionModel extends Model
{
    use HasFactory;
    protected $table = 'unit_conversions';
    protected $fillable = [
        'from_unit_id',
        'to_unit_id',
        'unit_id',
        'unit_conversion_id',
        'conversion_value',
        'conversion_name',
        'is_active',
        'created_by',
        'updated_by',
    ];  
}
