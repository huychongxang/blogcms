<?php

use App\Category;
use App\Post;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear data table categories
        DB::table('categories')->truncate();
        $time = Carbon::now();
        $categories = [
            [
                'title' => 'UnCategory',
                'slug' => 'uncategory',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'title' => 'Web Design',
                'slug' => 'web-design',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'title' => 'Web Programming',
                'slug' => 'web-programming',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'title' => 'Web Game',
                'slug' => 'web-game',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'title' => 'Social Marketing',
                'slug' => 'social-marketing',
                'created_at' => $time,
                'updated_at' => $time,
            ],
            [
                'title' => 'Internet',
                'slug' => 'internet',
                'created_at' => $time,
                'updated_at' => $time,
            ],
        ];
        DB::table("categories")->insert($categories);
        // update the posts data
        $categories = Category::pluck('id');
        foreach (Post::pluck('id') as $postId) {
            $categoryId = $categories[rand(0, $categories->count() - 1)];
            DB::table('posts')
                ->whereId($postId)
                ->update(['category_id' => $categoryId]);
        }
    }
}
