<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderModel extends Model
{
    use HasFactory;
    protected $table = 'purchase_order';

    protected $fillable = [
        'po_number',
        'po_date',
        'delivery_date',
        'status',
        'total',
        'partner_id',
        'created_by',
        'updated_by',
    ];
}
