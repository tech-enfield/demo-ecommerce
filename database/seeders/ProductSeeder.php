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
        $categories = Category::all()->keyBy('name');
        $brands = Brand::all()->keyBy('name');

        $productsData = [
            [
                'name' => 'Nike Mercurial Vapor 15',
                'category' => 'Football',
                'brand' => 'Nike',
                'description' => 'Lightweight football shoes designed for speed and traction.',
                'price' => 250,
                'discount_price' => 220,
                'variants' => [
                    ['size' => '7', 'color' => 'Black/Volt', 'stock' => 10],
                    ['size' => '8', 'color' => 'Black/Volt', 'stock' => 15],
                    ['size' => '9', 'color' => 'Black/Volt', 'stock' => 12],
                ],
                'images' => ['mercurial_1.jpg', 'mercurial_2.jpg'],
            ],
            [
                'name' => 'Adidas Predator Freak+',
                'category' => 'Football',
                'brand' => 'Adidas',
                'description' => 'Perfect control football shoes for precision and power.',
                'price' => 300,
                'discount_price' => 280,
                'variants' => [
                    ['size' => '7', 'color' => 'Core Black/White', 'stock' => 8],
                    ['size' => '8', 'color' => 'Core Black/White', 'stock' => 10],
                    ['size' => '9', 'color' => 'Core Black/White', 'stock' => 5],
                ],
                'images' => ['predator_1.jpg', 'predator_2.jpg'],
            ],
            [
                'name' => 'Puma Future Z 3.3',
                'category' => 'Football',
                'brand' => 'Puma',
                'description' => 'Dynamic football shoes with NETFIT technology for custom fit.',
                'price' => 220,
                'discount_price' => null,
                'variants' => [
                    ['size' => '7', 'color' => 'Red/Black', 'stock' => 12],
                    ['size' => '8', 'color' => 'Red/Black', 'stock' => 8],
                ],
                'images' => ['puma_future_1.jpg', 'puma_future_2.jpg'],
            ],
            [
                'name' => 'Nike Tiempo Legend 10',
                'category' => 'Football',
                'brand' => 'Nike',
                'description' => 'Premium leather football shoes for comfort and touch.',
                'price' => 280,
                'discount_price' => 250,
                'variants' => [
                    ['size' => '8', 'color' => 'White/Black', 'stock' => 10],
                    ['size' => '9', 'color' => 'White/Black', 'stock' => 7],
                ],
                'images' => ['tiempo_1.jpg', 'tiempo_2.jpg'],
            ],
            [
                'name' => 'Adidas X Speedflow.1',
                'category' => 'Football',
                'brand' => 'Adidas',
                'description' => 'Lightweight football shoes for acceleration and agility.',
                'price' => 260,
                'discount_price' => null,
                'variants' => [
                    ['size' => '7', 'color' => 'Solar Yellow/Black', 'stock' => 10],
                    ['size' => '8', 'color' => 'Solar Yellow/Black', 'stock' => 6],
                ],
                'images' => ['x_speedflow_1.jpg', 'x_speedflow_2.jpg'],
            ],
            [
                'name' => 'Nike Phantom GT2 Elite',
                'category' => 'Football',
                'brand' => 'Nike',
                'description' => 'High-performance shoes for precise dribbling and shooting.',
                'price' => 270,
                'discount_price' => 250,
                'variants' => [
                    ['size' => '8', 'color' => 'White/Volt', 'stock' => 12],
                    ['size' => '9', 'color' => 'White/Volt', 'stock' => 8],
                ],
                'images' => ['phantom_1.jpg', 'phantom_2.jpg'],
            ],
            [
                'name' => 'Puma King Platinum FG',
                'category' => 'Football',
                'brand' => 'Puma',
                'description' => 'Classic leather football shoes for stability and power.',
                'price' => 260,
                'discount_price' => null,
                'variants' => [
                    ['size' => '7', 'color' => 'Black/White', 'stock' => 10],
                    ['size' => '8', 'color' => 'Black/White', 'stock' => 5],
                ],
                'images' => ['king_platinum_1.jpg', 'king_platinum_2.jpg'],
            ],
            [
                'name' => 'Adidas Nemeziz+ 19.1',
                'category' => 'Football',
                'brand' => 'Adidas',
                'description' => 'Agility-focused football shoes for explosive movement.',
                'price' => 250,
                'discount_price' => 220,
                'variants' => [
                    ['size' => '7', 'color' => 'Red/Black', 'stock' => 12],
                    ['size' => '8', 'color' => 'Red/Black', 'stock' => 8],
                ],
                'images' => ['nemeziz_1.jpg', 'nemeziz_2.jpg'],
            ],
            [
                'name' => 'Nike Air Zoom Pegasus 40',
                'category' => 'Running',
                'brand' => 'Nike',
                'description' => 'Lightweight running shoes for daily training and long runs.',
                'price' => 180,
                'discount_price' => 150,
                'variants' => [
                    ['size' => '7', 'color' => 'Black/White', 'stock' => 20],
                    ['size' => '8', 'color' => 'Black/White', 'stock' => 15],
                ],
                'images' => ['pegasus_1.jpg', 'pegasus_2.jpg'],
            ],
            [
                'name' => 'Adidas Ultraboost 23',
                'category' => 'Running',
                'brand' => 'Adidas',
                'description' => 'Comfortable running shoes with responsive cushioning.',
                'price' => 200,
                'discount_price' => 180,
                'variants' => [
                    ['size' => '7', 'color' => 'White/Blue', 'stock' => 10],
                    ['size' => '8', 'color' => 'White/Blue', 'stock' => 8],
                ],
                'images' => ['ultraboost_1.jpg', 'ultraboost_2.jpg'],
            ],
        ];

        foreach ($productsData as $data) {
            $product = Product::create([
                'name' => $data['name'],
                'category_id' => $categories[$data['category']]->id,
                'brand_id' => $brands[$data['brand']]->id,
                'description' => $data['description'],
                'price' => $data['price'],
                'discount_price' => $data['discount_price'],
                'is_active' => true,
            ]);

            // Add variants
            foreach ($data['variants'] as $variant) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'size' => $variant['size'],
                    'color' => $variant['color'],
                    'stock' => $variant['stock'],
                ]);
            }

            // Add images
            foreach ($data['images'] as $index => $image) {
                Image::create([
                    'product_id' => $product->id,
                    'path' => $image,
                    'alt' => $product->name,
                    'is_primary' => $index === 0,
                ]);
            }
        }

        $this->command->info('Product Seeder file run successfully!');
    }
}
