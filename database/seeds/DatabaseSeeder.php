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
//        \App\Models\User::create([
//            'username' => 'Nathan',
//            'email' => 'nathan.geerinck@gmail.com',
//            'password' => bcrypt('test123'),
//        ]);

        \App\Models\MailingList::create([
            'name' => 'Test list',
            'description' => 'This is a cool test list called <b>Test List</b>',
            'user_id' => 3,
            'public' => 1,
        ]);

        \App\Models\Template::create([
            'name' => 'HTML Template',
            'content' => '<html><head><title>%subject%</title></head><body>This is the subject: %subject%<br>This is your name: %name%<br>This is your country: %country%<br>This is your unsubscribe link: <a href="%unsubscribe_link">%unsubscribe_link%</a> </body></html>',
            'user_id' => 3,
        ]);

        \App\Models\Template::create([
            'name' => 'Markdown Template',
            'content' => 'This is the subject: %subject%
                This is your name: %name%
                This is your country: %country%
                This is your unsubscribe link: [%unsubscribe_link%](%unsubscribe_link%)',
            'user_id' => 3,
        ]);
    }
}
