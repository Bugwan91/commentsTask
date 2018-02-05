<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Post;
use App\User;

class FakePostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();
        foreach (range(1,20) as $index) {
            Post::create([
                'user_id' => $users->random()->id,
                'title' => $faker->sentence,
                'content' => $faker->text(1000)
            ]);
        }
    }
}
