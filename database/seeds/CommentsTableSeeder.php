<?php

use App\Comment;
use App\Post;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $posts = Post::published()->latest()->get();
        $comments = [];
        foreach ($posts as $post) {
            for ($i = 0; $i <= rand(1, 10); $i++) {
                $commentDate = $post->published_at->modify("+{$i} hours");
                $comments[] = [
                    'user_name' => $faker->name,
                    'user_email' => $faker->email,
                    'user_url' => $faker->domainName,
                    'body' => $faker->paragraph(rand(1, 5), true),
                    'post_id' => $post->id,
                    'created_at' => $commentDate,
                    'updated_at' => $commentDate,
                ];
            }
        }
        Comment::insert($comments);
    }
}
