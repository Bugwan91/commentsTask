<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class FakeUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,10) as $index) {
            User::create([
                'name' => $faker->name,
                'password' => bcrypt('qwerty'),
                'email' => $faker->unique()->email,
            ]);
        }
    }
}
