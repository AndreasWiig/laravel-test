# Laravel Test

Requirements:

* docker
* docker compose

## Setup instructions

Clone this repository and install dependencies

    docker run --rm -v $PWD:/app composer install

Then start the development server and database with

    docker-compose up

Visit <http://127.0.0.1:8000/api/version> in your browser and you should see a version number.

Run migrations

    docker-compose exec api php artisan migrate

If you want to connect to the database:

    host: 127.0.0.1
    username: username
    password: password
    database: database

## Run tests

    docker-compose exec api ./vendor/bin/phpunit

## Level 1 - The tests are failing!

⏳ The tests are failing again and you have to do something about it. The clock is ticking and time is running out, these tests are preventing new functionality and bug fixes from reaching the production environment.

The task is simple, make the tests pass. All tests should be green, but every fixed test is a step in the right direction.

Remember that
- We are using tests as a form of documentation - so please read the test names before implementing a fix

Good luck!

## Level 2 - Add missing functionality

🏅 There are a few TODO's scattered around the project. Search for them and add the missing functionality. Remember to always add tests for new functionality.

## Level 3 - Logging in

💻 Users should of course be able to log in through the API and when they do we want to save their IP addresses together with a timestamp in a new database table.

This is what we want:

- Passport (or something else) to handle logins. Login requests should return access tokens. https://laravel.com/docs/8.x/passport#password-grant-tokens
- A database migration that creates a new database table for IP logging
- A model for the new database table
- Probably a http middleware that does the logging
- Model relationships between the user model and the "IP log" model
- Tests that verify that the logging works as expected

