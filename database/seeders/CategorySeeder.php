<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(['category_name' => 'Grocery','created_by' => 1]);
        Category::firstOrCreate(['category_name' => 'Food','created_by' => 1]);
        Category::firstOrCreate(['category_name' => 'Fish','created_by' => 1]);

    }
}
