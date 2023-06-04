<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Place::create([
            'zone_id' => 1,
            'c_name' => '行政楼底楼男厕所',
            'e_name' => null,
            'branch_id' => '1',
            'image' => 'test1.jpeg',
            'status'=> 'exist',
        ]);
        Place::create([
            'zone_id' => 2,
            'c_name' => '酒店8号房',
            'e_name' => null,
            'branch_id' => '1',
            'image' => 'test1.jpeg',
            'status'=> 'exist',
        ]);
        Place::create([
            'zone_id' => 3,
            'c_name' => '大伯公庙储藏室',
            'e_name' => null,
            'branch_id' => '2',
            'image' => null,
            'status'=> 'exist',
        ]);
    }
}
