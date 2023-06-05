<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //default Branch
        Branch::create([
            'name' => '绵裕亭 MYT',
            'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
            'description' => null,
            'image' => 'disney.jpeg',
            'status' => 'exist',
        ]);
        Branch::create([
            'name' => '墓园 GP',
            'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
            'description' => null,
            'image' => null,
            'status' => 'exist',
        ]);
        Branch::create([
            'name' => '古庙 Temple',
            'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
            'description' => null,
            'image' => null,
            'status' => 'exist',
        ]);
        Branch::create([
            'name' => '行政 WISMA',
            'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
            'description' => null,
            'image' => null,
            'status' => 'close',
        ]);
    }
}
