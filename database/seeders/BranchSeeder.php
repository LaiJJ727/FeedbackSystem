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
        // Branch::create([
        //     'name' => 'a',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);
        // Branch::create([
        //     'name' => 'b',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);
        // Branch::create([
        //     'name' => 'c',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);
        // Branch::create([
        //     'name' => 'd',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);
        // Branch::create([
        //     'name' => 'e',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);
        // Branch::create([
        //     'name' => 'f',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'g',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'h',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'i',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'j',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'k',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'l',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'm',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'n',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'o',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'p',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'q',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'r',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 's',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);
        // Branch::create([
        //     'name' => 't',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'u',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'v',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'w',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'x',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'y',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);Branch::create([
        //     'name' => 'z',
        //     'address' => 'Lot 4, Jalan Empat, Chan Sow Lin, 55200 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur',
        //     'description' => null,
        //     'image' => null,
        //     'status' => 'close',
        // ]);
    }
}
