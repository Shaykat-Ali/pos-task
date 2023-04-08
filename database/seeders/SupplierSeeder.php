<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::firstOrCreate(['company_name' => 'ABC','mobile_no' => '01792985242','email'=>'shaykatali932@gmail.com','address'=>'Dhaka']);
        Supplier::firstOrCreate(['company_name' => 'DEF','mobile_no' => '01792985242','email'=>'shaykatali932@gmail.com','address'=>'Chittagong']);

    }
}
