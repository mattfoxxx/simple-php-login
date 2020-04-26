# Simple php login POC

## Requirements
- a docker host with docker-compose tool installed

## How to run
1. Clone this repo.
2. Execute `docker-compose up -d` in root folder:
3. open [http://localhost:8080/register.php]() in your browser to create a new user
4. open [http://localhost:8080/index.php]()
5. use the link on that page to login with the newly created user.
6. to inspect the database from your browser, open [http://localhost:8081]() to access phpmyadmin.

## How to stop
1. Execute `docker-compose up -d` in root folder:


## Limitations
- user input validation is missing in `register.php`.
- `register.php` is not secured as it is just a convenience page to populate the database.
- passwords are stored in clear text in the `docker-compose.yml`. An .env file shoud be used and not commited in cvs.
- probably more, if I spend more time thinking about this. But this should be sufficient for a proof of concept (POC).

## Improvements
1. input validation.
2. use a templating engine for rendering html or roll your own in php.
3. use functions.