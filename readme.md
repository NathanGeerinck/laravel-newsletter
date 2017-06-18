# Laravel Newsletter

Laravel Newsletter is an application that can be used for sending newsletters to multiple subscribers, mailing lists, ... at once. This project can be used together with free mailing applications such as MailGun.

## Installation
1. Unzip the documents
2. Run `composer install`
3. Run `npm install`
3. Create the database and fill out the credentials in the .ENV file
4. Configure your [Queue](https://laravel.com/docs/5.3/queues) and [Command Schedule](https://laravel.com/docs/5.3/scheduling#introduction)
5. Run the migrations (php artisan migrate)
6. Create an account at /register
7. Login at /login
8. Fill out the settings at /settings
9. Send spam to everyone! :)
