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
            'place_id' => '1',
            'feedback_to' => 'General',
            'title_id' => '3',
            'description' => '灯泡a1 和 a2',
            'status' => 0,
            'image' => 'example.jpeg',
            'branch_id' => '1',
        ]);
        Feedback::create([
            'user_id' => '4',
            'place_id' => '2',
            'feedback_to' => 'Emergency',
            'title_id' => '3',
            'description' => '灯泡a1 和 a2',
            'status' => 0,
            'image' => 'example.jpeg',
            'branch_id' => '1',
        ]);
        Feedback::create([
            'user_id' => '4',
            'place_id' => '3',
            'feedback_to' => 'Housekeeping',
            'title_id' => '3',
            'description' => '灯泡a1 和 a2',
            'status' => 0,
            'image' => 'example.jpeg',
            'branch_id' => '1',
        ]);
    }
}
