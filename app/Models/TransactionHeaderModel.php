<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeaderModel extends Model
{
    use HasFactory;
    protected $table = 'transaction_headers';
    protected $fillable = [
        'code',
        'transaction_date',
        'description',
        'transaction_type',
        'po_so_id',
        'partner_id',
        'is_active',
        'created_by',
        'updated_by'
    ];
    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetailModel::class, 'transaction_id', 'id');
    }
    public function partner()
    {
        return $this->belongsTo(PartnerModel::class, 'partner_id', 'id');
    }
    public function po(){
        return $this->belongsTo(PurchaseOrderModel::class, 'po_so_id', 'id');
    }
    
}
