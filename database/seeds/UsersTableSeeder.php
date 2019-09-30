<?php

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $faker = Factory::create();
        $now = Carbon::now();
        DB::table("users")->insert([
            [
                'name' => "Huy",
                'slug' => 'huy',
                'email' => 'huychongxang@gmail.com',
                'password' => bcrypt('admin'),
                'bio' => $faker->text(rand(250, 300)),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => "Hung",
                'slug' => 'hung',
                'email' => 'hung@gmail.com',
                'password' => bcrypt('admin'),
                'bio' => $faker->text(rand(250, 300)),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => "Duong",
                'slug' => 'duong',
                'email' => 'duong@gmail.com',
                'password' => bcrypt('admin'),
                'bio' => $faker->text(rand(250, 300)),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
