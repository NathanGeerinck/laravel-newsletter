<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'username' => 'John',
            'email' => 'john.doe@gmail.com',
            'password' => bcrypt('test123'),
            'language' => 'en',
            'notifications_on' => true,
        ]);

        \App\Models\MailingList::create([
            'name' => 'Awesome newsfeed',
            'description' => 'This is a the mailinglist of the Awesome Newsfeed!',
            'user_id' => 1,
            'public' => 1,
        ]);

        \App\Models\Template::create([
            'name' => 'HTML Template',
            'content' => '<html><head><title>%subject%</title></head><body>This is the subject: %subject%<br>This is your name: %name%<br>This is your country: %country%<br>This is your unsubscribe link: <a href="%unsubscribe_link">%unsubscribe_link%</a> </body></html>',
            'user_id' => 1,
        ]);

        \App\Models\Campaign::create([
            'name' => 'Awesome newsfeed #1',
            'subject' => 'Awesome Newsfeed #1',
            'template_id' => 1,
            'user_id' => 1,
        ]);

        \App\Models\Subscription::create([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'country' => 'be',
            'mailing_list_id' => 1,
            'user_id' => 1,
        ]);

        \App\Models\Subscription::create([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@gmail.com',
            'country' => 'be',
            'mailing_list_id' => 1,
            'user_id' => 1,
        ]);

        \App\Models\Subscription::create([
            'name' => 'Tim Doe',
            'email' => 'tim.doe@gmail.com',
            'country' => 'us',
            'mailing_list_id' => 1,
            'user_id' => 1,
        ]);
    }
}