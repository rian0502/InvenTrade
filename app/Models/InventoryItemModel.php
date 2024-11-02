<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItemModel extends Model
{
    use HasFactory;
    protected $table = 'inventory_items';
    protected $fillable = ['item_id', 'stock', 'price', 'created_by', 'updated_by'];

    public function item()
    {
        return $this->belongsTo(ItemModel::class, 'item_id', 'id');
    }
}
