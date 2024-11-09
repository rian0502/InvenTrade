<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetailModel extends Model
{
    use HasFactory;

    protected $table = 'transaction_details';

    protected $fillable = [
        'quantity',
        'price',
        'discount',
        'total',
        'conversion_id',
        'transaction_id',
        'item_id',
        'unit_of_measure_id',
        'created_by',
        'updated_by'
    ];

    public function transactionHeader()
    {
        return $this->belongsTo(TransactionHeaderModel::class, 'transaction_id', 'id');
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
