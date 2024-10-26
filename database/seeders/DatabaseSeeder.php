<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PartnerModel;
use App\Models\PeriodClosingModel;
use App\Models\TaxModel;
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
        $faker = \Faker\Factory::create('id_ID');
        $admin = \App\Models\User::factory()->create([
            'name' => 'administrator',
            'email' => 'admin@inventrade.com',
            'username' => 'admin',
            'password' => bcrypt('1234'),
        ]);
        $gudang1 = \App\Models\User::factory()->create([
            'name' => $faker->name,
            'email' => $faker->safeEmail(),
            'username' => 'gudang-1',
            'password' => bcrypt('1234'),
        ]);
        $gudang2 = \App\Models\User::factory()->create([
            'name' => $faker->name,
            'email' => $faker->safeEmail(),
            'username' => 'gudang-2',
            'password' => bcrypt('1234'),
        ]);
        $gudang3 = \App\Models\User::factory()->create([
            'name' => $faker->name,
            'email' => $faker->safeEmail(),
            'username' => 'gudang-3',
            'password' => bcrypt('1234'),
        ]);
        $kasir = \App\Models\User::factory()->create([
            'name' => $faker->name,
            'email' => $faker->safeEmail(),
            'username' => 'kasir-1',
            'password' => bcrypt('1234'),
        ]);
        $kasir2 = \App\Models\User::factory()->create([
            'name' => $faker->name,
            'email' => $faker->safeEmail(),
            'username' => 'kasir-2',
            'password' => bcrypt('1234'),
        ]);
        $kasir3 = \App\Models\User::factory()->create([
            'name' => $faker->name,
            'email' => $faker->safeEmail(),
            'username' => 'kasir-3',
            'password' => bcrypt('1234'),
        ]);

        Role::insert(['name' => 'admin', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        Role::insert(['name' => 'gudang', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        Role::insert(['name' => 'kasir', 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]);
        $admin->assignRole('admin');
        $gudang1->assignRole('gudang');
        $gudang2->assignRole('gudang');
        $gudang3->assignRole('gudang');
        $kasir->assignRole('kasir');
        $kasir2->assignRole('kasir');
        $kasir3->assignRole('kasir');


        PartnerModel::factory(200)->create();

        PeriodClosingModel::create([
            'start_date' => '2024-10-15',
            'end_date' => '2024-11-15',
            'is_closed' => 0,
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        $this->call([
            UomSeeder::class,
            CategorySeeder::class,
            TaxSeeder::class,
            ItemSeeder::class
        ]);
    }
}
