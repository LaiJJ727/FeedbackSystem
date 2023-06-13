<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //default user

        //admin
        User::create([
            'username'=> 'admin',
            'name' => 'SuperAdmin',
            'email' => 'SuperAdmin@gmail.com',
            'role' => 'Admin',
            'branch_id' => 'all',
            'language' => 'Chinese',
            'phone' => '60123456789',
            'password' => Hash::make('super1234'),
        ]);
        //agent
        User::create([
            'username'=> 'agent001',
            'name' => 'Tan Zhuang He',
            'email' => 'agent@gmail.com',
            'role' => 'Agent',
            'branch_id' => '2',
            'language' => 'Chinese',
            'phone' => '0143886279',
            'password' => Hash::make('agent1234'),
        ]);
        //housekeep
        User::create([
            'username'=> 'housekeep001',
            'name' => 'Imah',
            'email' => 'housekeep@gmail.com',
            'role' => 'Housekeep',
            'branch_id' => '1',
            'language' => 'English',
            'phone' => '0169682362',
            'password' => Hash::make('housekeep1234'),
        ]);
        //staff
        User::create([
            'username'=> 'staff001',
            'name' => 'Chen Jia Le',
            'email' => 'staff@gmail.com',
            'role' => 'Staff',
            'branch_id' => '1',
            'language' => 'Chinese',
            'phone' => '60123456789',
            'password' => Hash::make('staff1234'),
        ]);
    }
}
