<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodClosingModel extends Model
{
    use HasFactory;
    protected $table = 'closing_periods';

    protected $fillable = [
        'start_date',
        'end_date',
        'is_closed',
        'created_by',
        'updated_by',
    ];
}
