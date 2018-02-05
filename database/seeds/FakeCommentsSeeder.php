<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Comment;
use App\Post;
use App\User;

class FakeCommentsSeeder extends Seeder
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
        $posts = Post::all();
        foreach ($posts as $post) {
            foreach (range(1,rand(1,10)) as $i) {
                $comment = Comment::create([
                    'user_id' => $users->random()->id,
                    'post_id' => $post->id,
                    'content' => $faker->text(300)
                ]);
                foreach (range(1, rand(1, 3)) as $j) {
                    $comment = Comment::create([
                        'user_id' => $users->random()->id,
                        'post_id' => $post->id,
                        'content' => $faker->text(300),
                        'reply_to_id' => $comment->id
                    ]);
                }
            }
        }
    }
}
