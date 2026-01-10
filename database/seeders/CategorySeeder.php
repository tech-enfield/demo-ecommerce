<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryRelation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Football', 'slug' => 'football'],
            ['name' => 'Basketball', 'slug' => 'basketball'],
            ['name' => 'Running', 'slug' => 'running'],
            ['name' => 'Gym', 'slug' => 'gym'],
            ['name' => 'Accessories', 'slug' => 'accessories'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
        $this->command->info('Category Seeder run successfully!');
    }
}
