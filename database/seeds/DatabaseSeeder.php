<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
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
            DB::table('users')->insert([
                'username' => $faker->username,
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'password' => $faker->password,
            ]);
        }
        foreach (range(1,5) as $index) {
            DB::table('mailing_lists')->insert([
                   'name'  => $faker->company,
                   'description' => $faker->paragraph,
                   'public' => 1,
                   'user_id' => \App\Models\User::find(rand(1,10))->id,
                ]);
        }
        foreach (range(1,100) as $index) {
            $sub = new \App\Models\Subscription;
            $sub->email = $faker->email;
            $sub->name = $faker->name;
            $sub->country = array_rand(countries());
            $sub->user_id = \App\Models\User::find(rand(1,10))->id;
            $sub->mailing_list_id = \App\Models\MailingList::find(rand(1,5))->id;

            $sub->save();
        }
    }
}
