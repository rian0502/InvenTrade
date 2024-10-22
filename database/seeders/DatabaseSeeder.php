<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PeriodClosingModel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $admin = \App\Models\User::factory()->create([
            'name' => 'administrator',
            'email' => 'admin@inventrade.com',
            'username' => 'admin',
            'password' => bcrypt('1234'),
        ]);
        Role::insert(['name' => 'admin', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        Role::insert(['name' => 'gudang', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        Role::insert(['name' => 'kasir', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        $admin->assignRole('admin');

        $this->call([
            UomSeeder::class,
            CategorySeeder::class,
        ]);

        PeriodClosingModel::create([
            'start_date' => '2024-10-15',
            'end_date' => '2024-11-15',
            'is_closed' => 0,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}
