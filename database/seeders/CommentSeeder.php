<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //default Comment
        Comment::create([
            'user_id' => '4',
            'feedback_id' => '3',
            'description' => 'Sudah Siap Cuci',
            'image' => 'photo wall.png',
            'click_status' => '1',
        ]);
        Comment::create([
            'user_id' => '3',
            'feedback_id' => '1',
            'description' => 'Checking',
            'image' => null,
            'click_status' => '2',
        ]);
    }
}
