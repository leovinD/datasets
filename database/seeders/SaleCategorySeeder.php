<?php

namespace Database\Seeders;

use App\Models\SaleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            'Accessories', 
            'Electronics'
        ];

        foreach ($categories as $category) {
            DB::table('sale_categories')->insert([
                'category_name' => $category,
            ]);
        }
    }
}
