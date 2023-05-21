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
            'zone' => '行政楼 Admin Building',
            'c_name' => '行政楼底楼男厕所',
            'e_name' => '-',
            'branch_id' => '1',
            'status'=> 'exist',
        ]);
        Place::create([
            'zone' => '酒店 Hotel',
            'c_name' => '酒店8号房',
            'e_name' => '-',
            'branch_id' => '1',
            'status'=> 'exist',
        ]);
        Place::create([
            'zone' => '大伯公庙  Tokong',
            'c_name' => '大伯公庙储藏室',
            'e_name' => '-',
            'branch_id' => '2',
            'status'=> 'exist',
        ]);
    }
}
