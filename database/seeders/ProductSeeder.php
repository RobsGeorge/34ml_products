<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Option;
use App\Models\Variant;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample product
        $product = Product::create([
            'title' => 'Sample Product',
            'is_in_stock' => true,
            'average_rating' => 4.5
        ]);

        // Create options
        $colorOption = Option::create([
            'name' => 'Color',
            'values' => ['red', 'blue', 'green']
        ]);

        $sizeOption = Option::create([
            'name' => 'Size',
            'values' => ['small', 'medium', 'large']
        ]);

        // Attach options to product
        $product->options()->attach([$colorOption->id, $sizeOption->id]);

        // Create variants
        $variant1 = $product->variants()->create([
            'title' => 'Red Small',
            'option1' => 'red',
            'option2' => 'small',
            'price' => 19.99,
            'stock' => 10,
            'is_in_stock' => true
        ]);

        $variant2 = $product->variants()->create([
            'title' => 'Blue Medium',
            'option1' => 'blue',
            'option2' => 'medium',
            'price' => 24.99,
            'stock' => 5,
            'is_in_stock' => true
        ]);

        // Set default variant
        $product->default_variant_id = $variant1->id;
        $product->save();
        
        // Add more products as needed
        $product2 = Product::create([
            'title' => 'Premium Product',
            'is_in_stock' => true,
            'average_rating' => 4.8
        ]);
        
        // Attach options
        $product2->options()->attach([$colorOption->id, $sizeOption->id]);
        
        // Create variants
        $premium1 = $product2->variants()->create([
            'title' => 'Green Large',
            'option1' => 'green',
            'option2' => 'large',
            'price' => 39.99,
            'stock' => 8,
            'is_in_stock' => true
        ]);
        
        $premium2 = $product2->variants()->create([
            'title' => 'Blue Large',
            'option1' => 'blue',
            'option2' => 'large',
            'price' => 34.99,
            'stock' => 3,
            'is_in_stock' => true
        ]);
        
        // Set default variant
        $product2->default_variant_id = $premium2->id;
        $product2->save();
    }
}
