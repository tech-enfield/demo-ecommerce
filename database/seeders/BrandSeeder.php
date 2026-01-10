<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $brands = [
            ['name' => 'Nike', 'logo' => 'nike.png'],
            ['name' => 'Adidas', 'logo' => 'adidas.png'],
            ['name' => 'Puma', 'logo' => 'puma.png'],
            ['name' => 'Reebok', 'logo' => 'reebok.png'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        $this->command->info('Brand Seeder run success');
    }
}
