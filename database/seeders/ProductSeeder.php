<?php

namespace Database\Seeders;

use App\Models\AttributeGroup;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductVariant;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $categories = Category::all();
        $brands = Brand::all();

        $sizes = ['6','7','8','9','10','11','12'];
        $colors = ['Black', 'White', 'Red', 'Blue', 'Green', 'Yellow'];

        for ($i = 1; $i <= 50; $i++) {

            $category = $categories->random();
            $brand = $brands->random();

            $product = Product::create([
                'name' => ucfirst($faker->words(3, true)),
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'description' => $faker->paragraph(),
                'price' => $faker->numberBetween(50, 300),
                'discount_price' => $faker->boolean(50) ? $faker->numberBetween(40, 250) : null,
                'is_active' => true,
            ]);

            // Add 2-4 images
            $numImages = $faker->numberBetween(2, 4);
            for ($j = 1; $j <= $numImages; $j++) {
                Image::create([
                    'product_id' => $product->id,
                    'path' => "product_{$i}_{$j}.jpg",
                    'alt' => $product->name,
                    'is_primary' => $j === 1,
                ]);
            }

            // Add 1-6 variants
            $variantCount = $faker->numberBetween(1, 6);
            $variantSizes = $faker->randomElements($sizes, $variantCount);
            foreach ($variantSizes as $size) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'size' => $size,
                    'color' => $faker->randomElement($colors),
                    'stock' => $faker->numberBetween(5, 50),
                ]);
            }
        }

        $this->command->info('Product Seeder file run successfully!');
    }
}
