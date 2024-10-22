<?php

namespace Database\Seeders;

use App\Models\UnitOfMeasureModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class UomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        UnitOfMeasureModel::create([
            'name' => 'Kilogram',
            'symbol' => 'Kg',
            'description' => 'Kilogram',
        ]);
        UnitOfMeasureModel::create([
            'name' => 'Gram',
            'symbol' => 'g',
            'description' => 'Gram',
        ]);
        UnitOfMeasureModel::create([
            'name' => 'Liter',
            'symbol' => 'L',
            'description' => 'Liter',
        ]);
        UnitOfMeasureModel::create([
            'name' => 'Milliliter',
            'symbol' => 'mL',
            'description' => 'Milliliter',
        ]);
        UnitOfMeasureModel::create([
            'name' => 'Piece',
            'symbol' => 'Pc',
            'description' => 'Piece',
        ]);
        UnitOfMeasureModel::create([
            'name' => 'Box',
            'symbol' => 'Box',
            'description' => 'Box',
        ]);
        UnitOfMeasureModel::create([
            'name' => 'Bag',
            'symbol' => 'Bag',
            'description' => 'Bag',
        ]);
        UnitOfMeasureModel::create([
            'name' => 'Bottle',
            'symbol' => 'Bottle',
            'description' => 'Bottle',
        ]);
        UnitOfMeasureModel::create([
            'name' => 'Can',
            'symbol' => 'Can',
            'description' => 'Can',
        ]);
        UnitOfMeasureModel::create([
            'name' => 'Pack',
            'symbol' => 'Pack',
            'description' => 'Pack',
        ]);
        UnitOfMeasureModel::create([
            'name' => 'Unit',
            'symbol' => 'Unit',
            'description' => 'Unit',
        ]);
        UnitOfMeasureModel::create([
            'name' => 'Dozen',
            'symbol' => 'Dozen',
            'description' => 'Dozen',
        ]);
        

        
    }
}
