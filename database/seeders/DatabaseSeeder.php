<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ApiSeeder::class,
            BranchSeeder::class,
            CommentSeeder::class,
            FeedbackSeeder::class,
            PlaceSeeder::class,
            TitleSeeder::class,
            CategorySeeder::class,
            ZoneSeeder::class,

        ]);
    }
}
