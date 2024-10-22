<?php

namespace Database\Seeders;

use App\Models\CategoryModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CategoryModel::create([
            'name' => 'Rokok',
            'description' => 'Semua Jenis Rokok',
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        CategoryModel::create([
            'name' => 'Makanan',
            'description' => 'Semua Jenis Makanan',
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        CategoryModel::create([
            'name' => 'Minuman',
            'description' => 'Semua Jenis Minuman',
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        CategoryModel::create([
            'name' => 'Plastik',
            'description' => 'Semua Jenis Plastik',
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        CategoryModel::create([
            'name' => 'Minyak',
            'description' => 'Semua Jenis Minyak',
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        CategoryModel::create([
            'name' => 'Sabun',
            'description' => 'Semua Jenis Sabun',
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        CategoryModel::create([
            'name' => 'Pasta Gigi',
            'description' => 'Semua Jenis Pasta Gigi',
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        CategoryModel::create([
            'name' => 'Shampoo',
            'description' => 'Semua Jenis Shampoo',
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        CategoryModel::create([
            'name' => 'Obat-obatan',
            'description' => 'Semua Jenis Obat-obatan',
            'is_active' => true,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
