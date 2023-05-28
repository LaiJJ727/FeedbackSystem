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
        Category::create([
            'c_name' => '厕所',
            'e_name' => 'Toilet',
            'status'=> 'exist',
        ]);
        Category::create([
            'c_name' => '办公室',
            'e_name' => 'Office',
            'status'=> 'exist',
        ]);
    }
}
