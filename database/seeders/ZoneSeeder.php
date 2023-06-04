<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Zone::create([
            'c_name' => '行政楼',
            'e_name' => 'Admin Building',
            'status'=> 'exist',
        ]);

        Zone::create([
            'c_name' => '酒店',
            'e_name' => 'Hotel',
            'status'=> 'exist',
        ]);

        Zone::create([
            'c_name' => '大伯公庙',
            'e_name' => 'Tokong',
            'status'=> 'exist',
        ]);
    }
}
