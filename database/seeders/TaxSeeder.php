<?php

namespace Database\Seeders;

use App\Models\TaxModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TaxModel::create([
            'name' => 'Pajak Pertambahan Nilai',
            'rate' => 11,
            'is_active' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        TaxModel::create([
            'name' => 'PPH 23',
            'rate' => 2.5,
            'is_active' => 1,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
