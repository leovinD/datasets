<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $regions = [
            'East', 
            'West', 
            'North', 
            'South'
        ];

        foreach ($regions as $region) {
            DB::table('regions')->insert([
                'region_name' => $region,
            ]);
        }
    }
}
