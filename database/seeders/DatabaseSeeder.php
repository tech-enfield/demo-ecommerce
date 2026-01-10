<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'super-admin', 'guard_name' => 'web']);
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'customer', 'guard_name' => 'web']);

        $superUser = User::create([
            'name' => 'The Super Admin',
            'email' => 'info@techenfield.com',
            'password' => Hash::make('password')
        ]);

        $superUser->assignRole('super-admin');

        $this->call([
            ProvinceDistrictMunicipalitySeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            // CategorySeeder::class,
            // ProductSeeder::class,
            // AttributeSeeder::class,
        ]);
    }
}
