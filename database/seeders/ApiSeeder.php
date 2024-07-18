<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\API;

class ApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        API::create([
            'api' => 'd5bd09371f31fd7c8efa78d1732d24f9e3f96a8643dd05f6075dedcd19c05452',
            'service_name' => 'OnSend',
            'service_type' => 'Whatsapp',
            'in_used' => 'F',
        ]);
    }
}
