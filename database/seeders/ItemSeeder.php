<?php

namespace Database\Seeders;

use App\Models\CategoryModel;
use App\Models\ItemModel;
use Illuminate\Database\Seeder;
use App\Models\UnitOfMeasureModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $items = [
            [
                'code' => 'ITM00001',
                'name' => 'Surya 16',
                'description' => 'Rokok Surya 16 Batang',
                'category_id' => CategoryModel::where('name', 'Rokok')->first()->id,
                'uom_id' => UnitOfMeasureModel::where('name', 'Pack')->first()->id,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'code' => 'ITM00002',
                'name' => 'Surya 12',
                'description' => 'Rokok Surya 12 Batang',
                'category_id' => CategoryModel::where('name', 'Rokok')->first()->id,
                'uom_id' => UnitOfMeasureModel::where('name', 'Pack')->first()->id,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'code' => 'ITM00003',
                'name' => 'Sunnia 2L',
                'description' => 'Minyak Sunnia 2 Liter',
                'category_id' => CategoryModel::where('name', 'Minyak')->first()->id,
                'uom_id' => UnitOfMeasureModel::where('name', 'Liter')->first()->id,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'code' => 'ITM00004',
                'name' => 'Palma 1L',
                'description' => 'Minyak Palma 1 Liter',
                'category_id' => CategoryModel::where('name', 'Minyak')->first()->id,
                'uom_id' => UnitOfMeasureModel::where('name', 'Liter')->first()->id,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'code' => 'ITM00005',
                'name' => 'Lifebuoy Bar Soap 100g',
                'description' => 'Sabun Lifebuoy 100 gram',
                'category_id' => CategoryModel::where('name', 'Sabun')->first()->id,
                'uom_id' => UnitOfMeasureModel::where('name', 'Piece')->first()->id,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'code' => 'ITM00006',
                'name' => 'Pepsodent 190g',
                'description' => 'Pasta Gigi Pepsodent 190 gram',
                'category_id' => CategoryModel::where('name', 'Pasta Gigi')->first()->id,
                'uom_id' => UnitOfMeasureModel::where('name', 'Piece')->first()->id,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'code' => 'ITM00007',
                'name' => 'Sunsilk 170ml',
                'description' => 'Shampo Sunsilk 170 ml',
                'category_id' => CategoryModel::where('name', 'Shampoo')->first()->id,
                'uom_id' => UnitOfMeasureModel::where('name', 'Piece')->first()->id,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'code' => 'ITM00008',
                'name' => 'Dove 200ml',
                'description' => 'Body Wash Dove 200 ml',
                'category_id' => CategoryModel::where('name', 'Sabun')->first()->id,
                'uom_id' => UnitOfMeasureModel::where('name', 'Piece')->first()->id,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'code' => 'ITM00009',
                'name' => 'Molto 800ml',
                'description' => 'Pewangi Molto 800 ml',
                'category_id' => CategoryModel::where('name', 'Sabun')->first()->id,
                'uom_id' => UnitOfMeasureModel::where('name', 'Piece')->first()->id,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'code' => 'ITM00010',
                'name' => 'Sariwangi 500g',
                'description' => 'Teh Sariwangi 500 gram',
                'category_id' => CategoryModel::where('name', 'Minuman')->first()->id,
                'uom_id' => UnitOfMeasureModel::where('name', 'Piece')->first()->id,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1
            ],
            //obat-obatan
            [
                'code' => 'ITM00011',
                'name' => 'Panadol 500mg',
                'description' => 'Obat Panadol 500 mg',
                'category_id' => CategoryModel::where('name', 'Obat-obatan')->first()->id, 
                'uom_id' => UnitOfMeasureModel::where('name', 'Pack')->first()->id,
                'is_active' => true,
                'created_by' => 1,
                'updated_by' => 1
            ]
        ];

        foreach ($items as $item) {
            ItemModel::create($item);
        }
    }
}
