<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderModel extends Model
{
    use HasFactory;
    protected $table = 'purchase_order_headers';

    protected $fillable = [
        'po_number',
        'po_date',
        'delivery_date',
        'status',
        'total',
        'description',
        'partner_id',
        'created_by',
        'updated_by',
    ];

    public function purchaseOrderDetails()
    {
        return $this->hasMany(PODetailModel::class, 'purchase_order_header_id', 'id');
    }

    public function partner()
    {
        return $this->belongsTo(PartnerModel::class, 'partner_id', 'id');
    }

    public function purchaseOrderTaxes()
    {
        return $this->hasMany(POTaxModel::class, 'order_id', 'id');
    }

    public function transaction()
    {
        return $this->hasOne(TransactionHeaderModel::class, 'po_so_id', 'id');
    }


}
