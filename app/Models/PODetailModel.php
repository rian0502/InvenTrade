<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PODetailModel extends Model
{
    use HasFactory;

    protected $table = 'po_details';

    protected $fillable = [
        'quantity',
        'price',
        'qty',
        'subtotal',
        'item_id',
        'purchase_order_header_id',
        'created_by',
        'updated_by',
    ];
}
