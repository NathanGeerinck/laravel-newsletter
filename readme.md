<img src="./logo.png" width="150px">

# Laravel Newsletter

[![StyleCI](https://styleci.io/repos/76723997/shield?branch=master)](https://styleci.io/repos/76723997) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/NathanGeerinck/laravel-newsletter/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/NathanGeerinck/laravel-newsletter/?branch=master) [![Code Intelligence Status](https://scrutinizer-ci.com/g/NathanGeerinck/laravel-newsletter/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence) [![Code Intelligence Status](https://scrutinizer-ci.com/g/NathanGeerinck/laravel-newsletter/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

Laravel Newsletter is an open source project that can be used for sending newsletters to multiple subscribers, mailing lists, ... at once. This project can be used together with free mailing applications such as MailGun.

## Installation

### Step 1
First of all you need to clone the repository and install it using composer.
```bash
git clone git@github.com:NathanGeerinck/laravel-newsletter.git
cd laravel-newsletter && composer install
php artisan laravel-newsletter:install
npm run production
```

### Step 2
Then you need to create a database and fill out the credentials in the `.env` file. An example:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-newsletter
DB_USERNAME=root
DB_PASSWORD=root
```

Once you've created the database you can migrate all the tables into your database by running:
```bash
php artisan migrate
```

If you want to import the demo data then you can run:
```bash
php artisan laravel-newsletter:demo
```

### Step 3
For sending emails you need to fillout your mail credentials.. You can use a service like [MailGun](https://www.mailgun.com/). You can adjust these settings also in the `.env` file.
```
MAIL_DRIVER=smtp
MAIL_HOST=mailgun.org
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null
```

### Step 4
If you want to use a [Queue](https://laravel.com/docs/5.3/queues), it's possible!


### Finish
Now you're ready to rock and roll! Visit the `/register` page of you're application and create an account! ;)

> If you ran the `php artisan laravel-newsletter:demo` command, you can login with 'john.doe@gmail.com' and 'test123'.

## Roadmap
* Translate the application to more languages (now available: English, Dutch)
* Email bounce tracking
* Creating an API

## License
The laravel-newsletter application is open source software licensed under the [license MIT](https://opensource.org/licenses/MIT).

## Contributors
* [Cannonb4ll](https://github.com/Cannonb4ll)
