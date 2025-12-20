<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProvinceDistrictMunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('sql/province-district-municipalities.sql');

        $sql = File::get($path);

        // Execute SQL statements
        DB::unprepared($sql);

        $this->command->info('SQL file imported successfully!');
    }
}
