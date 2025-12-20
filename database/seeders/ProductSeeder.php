<?php

namespace Database\Seeders;

use App\Models\AttributeGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        Product::insert([
            ['name' => 'Acer Predator Triton Neo 16', 'slug' => 'acer-predator-triton-neo-16', 'sku' => 'Acer-Predator-Triton-Neo-16', 'short_description' => 'The Acer Predator Triton Neo 16 cost NPR 264,999 for the Ultra 9 185H with RTX 4060 where as the powerful RTX 4070 comes at NPR 295,999.', 'description' => 'Keeping pace with the tech world’s rhythm, Acer unveiled the Predator Triton Neo 16 with Meteor Lake Intel Core Ultra chips a couple of months ago. In this article, let’s talk about the design, features, specifications, chipset, availability, and price in Nepal of the Acer Predator Triton Neo 16 (2024).', 'meta_title' => 'acer predator gaming laptop', 'meta_description' => "Buy the Acer Predator Triton Neo 16 series on Store 9Nepal.", "meta_keywords" => 'laptop, gaming laptop, acer, acer predator, predator, acer laptop', 'created_at' => $now, 'updated_at' => $now],
        ]);

        $this->command->info('Product Seeder file run successfully!');
    }
}
