<h1 align="center">Laravel Test</h1>

## Introduction

I am Alexander Mamaril, senior Laravel developer with over 7 years' experience. I have completed Skill Test.

> This is a sever for api


## Installation

To install this Test Project:

You can install this test laravel project with these **3 simple steps**:

### 1. Create a New Database

We'll need to utilize a MySQL database during the installation. For the following stage, you'll need to create a new database and preserve the credentials.

### 2. Copy the `.env.example` file

We need to specify our Environment variables for our application. You will see a file named `.env.example`, you will need to duplicate that file and rename it to `.env`.

Then, open up the `.env` file and update your _DB_DATABASE_, _DB_USERNAME_, and _DB_PASSWORD_ in the appropriate fields. You will also want to update the _APP_URL_ to the URL of your application.

```bash
APP_URL=http://127.0.0.1:8000/
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=assess_laravel_react
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migrations and Seeds

We must migrate our database schema into our database, which we can accomplish by running the following command:

```php
php artisan migrate
```

Finally, we will need to seed our database with the following command:

```php
php artisan db:seed
```

That's it! You will now be able to visit your URL and see your Surrf application up and running. 🎉

Once done, run the Server with the following command:

```php
php artisan serve
```

Verify the deployment by navigating to your server address in
your preferred browser.

```sh
http://127.0.0.1:8000
```
