<?php

namespace Database\Seeders;

use App\Models\Salesperson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalespersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $salespeople = [
            'Ethan', 
            'Bob', 
            'Charlie', 
            'Diana', 
            'Alice'
        ];

        foreach ($salespeople as $salesperson) {
            DB::table('salespeople')->insert([
                'salepeople_name' => $salesperson,
        ]);
    }
}
}
