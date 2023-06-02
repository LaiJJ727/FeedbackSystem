<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Title;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Title::create([
            'category_id' => '1',
            'c_name' => '马桶堵塞',
            'e_name' => 'Toilet Bowl Stucked',
            'image' => '2.png',
            'status'=> 'exist',
        ]);
        Title::create([
            'category_id' => '1',
            'c_name' => '马桶盖坏了',
            'e_name' => '-',
            'image' => '2.png',
            'status'=> 'exist',
        ]);
        Title::create([
            'category_id' => '1',
            'c_name' => '无法抽水',
            'e_name' => 'Cannot Flush',
            'image' => 'test1.jpeg',
            'status'=> 'exist',
        ]);
        Title::create([
            'category_id' => '2',
            'c_name' => '电脑桌脚损坏',
            'e_name' => '-',
            'image' => 'test1.jpeg',
            'status'=> 'exist',
        ]);
    }
}
