<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PODetailModel extends Model
{
    use HasFactory;

    protected $table = 'purchase_order_details';

    protected $fillable = [
        'quantity',
        'price',
        'subtotal',
        'discount',
        'item_id',
        'unit_of_measure_id',
        'purchase_order_header_id',
        'created_by',
        'updated_by'
    ];

    public function purchaseOrderHeader()
    {
        return $this->belongsTo(PurchaseOrderModel::class, 'purchase_order_header_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(ItemModel::class, 'item_id', 'id');
    }

    public function unitOfMeasure()
    {
        return $this->belongsTo(UnitOfMeasureModel::class, 'unit_of_measure_id', 'id');
    }
}
