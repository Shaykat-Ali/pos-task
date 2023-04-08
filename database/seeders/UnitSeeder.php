<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::firstOrCreate(['unit_name' => 'Kg','created_by' => 1]);
        Unit::firstOrCreate(['unit_name' => 'L','created_by' => 1]);
        Unit::firstOrCreate(['unit_name' => 'Pack','created_by' => 1]);
    }
}
