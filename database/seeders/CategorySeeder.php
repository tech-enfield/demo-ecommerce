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
        $now = now();
        Category::insert([
            ['name' => 'Laptop', 'slug' => 'laptop', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Accessories', 'slug' => 'accessories', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Brand', 'slug' => 'brand', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Acer', 'slug' => 'acer', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Acer Predator', 'slug' => 'predator', 'created_at' => $now, 'updated_at' => $now],
        ]);
        CategoryRelation::insert([
            ['parent_category_id' => 1, 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['parent_category_id' => 2, 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['parent_category_id' => 3, 'category_id' => 4, 'created_at' => $now, 'updated_at' => $now],
            ['parent_category_id' => 1, 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now],
            ['parent_category_id' => 4, 'category_id' => 5, 'created_at' => $now, 'updated_at' => $now],
        ]);

                $this->command->info('Category Seeder run successfully!');

    }
}
