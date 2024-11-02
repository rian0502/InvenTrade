<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = [
        'code',
        'name',
        'description',
        'category_id',
        'uom_id',
        'is_active',
        'created_by',
        'updated_by'
    ];
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }
    public function uom()
    {
        return $this->belongsTo(UnitOfMeasureModel::class, 'uom_id');
    }
    public function inventory()
    {
        return $this->hasOne(InventoryItemModel::class, 'item_id', 'id');
    }
}
