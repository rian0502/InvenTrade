<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POTaxModel extends Model
{
    use HasFactory;
    protected $table = 'purchase_order_taxes';

    protected $fillable = [
        'amount',
        'tax_id',
        'order_id',
        'created_by',
        'updated_by'
    ];

    public function purchaseOrderHeader()
    {
        return $this->belongsTo(PurchaseOrderModel::class, 'order_id', 'id');
    }

}
