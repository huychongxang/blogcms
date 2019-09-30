<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->truncate();

        $php = new Tag();
        $php->name = "PHP";
        $php->slug = "php";
        $php->save();

        $laravel = new Tag();
        $laravel->name = "Laravel";
        $laravel->slug = "laravel";
        $laravel->save();

        foreach (Post::pluck('id') as $postId) {
            $post = Post::find($postId);
            $post->tags()->detach();
            $tag = rand(true, false) ? $php : $laravel;
            $post->tags()->attach($tag);
        }
    }
}
