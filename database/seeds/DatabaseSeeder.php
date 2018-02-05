<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(FakeUsersSeeder::class);
         $this->call(FakePostsSeeder::class);
         $this->call(FakeCommentsSeeder::class);
    }
}
