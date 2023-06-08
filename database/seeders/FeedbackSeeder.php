<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feedback;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feedback::create([
            'user_id' => '4',
            'branch_id' => '1',
            'zone_id' => '1',
            'place_id' => '1',
            'category_id' => '1',
            'title_id' => '3',
            'feedback_to' => 'General',
            'description' => '灯泡a1 和 a2',
            'status' => 0,
            'image' => 'example.jpeg',
        ]);
        Feedback::create([
            'user_id' => '4',
            'branch_id' => '1',
            'zone_id' => '1',
            'place_id' => '2',
            'category_id' => '1',
            'title_id' => '3',
            'feedback_to' => 'Emergency',
            'description' => '灯泡a1 和 a2',
            'status' => 0,
            'image' => 'example.jpeg',
        ]);
        Feedback::create([
            'user_id' => '4',
            'branch_id' => '1',
            'zone_id' => '1',
            'category_id' => '1',
            'place_id' => '3',
            'title_id' => '3',
            'feedback_to' => 'Housekeeping',
            'description' => '灯泡a1 和 a2',
            'status' => 0,
            'image' => 'example.jpeg',
        ]);
    }
}
