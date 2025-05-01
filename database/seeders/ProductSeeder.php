<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SaleCategory;
use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $category = SaleCategory::first() ?? SaleCategory::create(['name' => 'Default Category']);
        
        
        // $region = Region::first() ?? Region::create(['region_name' => 'Default Region']);
        
        
        $products = [
            'Headphones', 
            'Laptop', 
            'Tablet', 
            'Smartwatch', 
            'Smartphone'
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'product_name' => $product,
                'sale_category_id' => $category->id,
                // 'region_id' => $region->id, 
            ]);
        }
    }
}

