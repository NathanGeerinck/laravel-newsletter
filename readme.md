# Laravel Newsletter

Laravel Newsletter is an open source project that can be used for sending newsletters to multiple subscribers, mailing lists, ... at once. This project can be used together with free mailing applications such as MailGun.

## Installation

### Step 1
First of all you need to clone the repository and install it using composer.
```bash
git clone git@github.com:NathanGeerinck/laravel-newsletter.git
cd laravel-newsletter && composer install
mv .env.example .env
php artisan key:generate
npm install
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

### Step 3 
Once you've created the database you can migrate all the tables into your database by running:
```bash
php artisan migrate
```

### Step 4
For sending emails you need to fillout your mail credentials.. You can use a service like [MailGun](https://www.mailgun.com/). You can adjust these settings also in the `.env` file.
```
MAIL_DRIVER=smtp
MAIL_HOST=mailgun.org
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=null
```

### Step 5
If you want to use a [Queue](https://laravel.com/docs/5.3/queues), it's possible!


### Finish
Now you're ready to rock and roll! Visit the `/register` page of you're application and create an account! ;)

## Roadmap
* Translate the application to more languages (now available: English, Dutch)
* Email bounce tracking
* Creating an API

## Contributors
* [Cannonb4ll](https://github.com/Cannonb4ll)
