[![CircleCI](https://circleci.com/gh/botnetdobbs/LumenLibraryAPI.svg?style=svg)](https://circleci.com/gh/botnetdobbs/LumenLibraryAPI)
[![Maintainability](https://api.codeclimate.com/v1/badges/b2b6b6e77d685a07c408/maintainability)](https://codeclimate.com/github/botnetdobbs/LumenLibraryAPI/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/b2b6b6e77d685a07c408/test_coverage)](https://codeclimate.com/github/botnetdobbs/LumenLibraryAPI/test_coverage)

### Interact with the [Hosted API](https://lumenlibraryapi.herokuapp.com/api/v1/books)

## Setup

### Dependencies

* [PHP 7](http://php.net/) - popular general-purpose scripting language suited to web development
* [Lumen 5.8](https://lumen.laravel.com/docs/5.8) - The stunningly fast micro-framework by Laravel

### Getting Started

Setting up project in development mode

* Ensure PHP 7.0+ is installed by running:
```
php -v
```

* Clone the repository to your machine and navigate into it:
```
git clone https://github.com/botnetdobbs/LumenLibraryAPI.git && cd LumenLibraryAPI
```
* Install application dependencies:
```
composer install
```
* Create a *.env* file and include the necessary environment variables. NB- copy from the *.env.example* and fill in the correct values

## Database setup
Create your database locally on your machine, i.e `lumen_library_api`cand add it as a value to the respective environment variable as below.
```
DB_DATABASE=lumen_library_api
```


## Running the application
Inside the project root folder, run the command below in your console
```
$ php artisan migrate:fresh
```
```
$ php artisan db:seed
```
```
$ php -S localhost:8001 -t public
```


## Running the tests

```
- $ ./vendor/bin/phpunit
```


| Method | Endpoint | Params |
| ------ | ------ | ------- |
| POST | ```api/v1/auth/register``` | ```json {"name": "Imega Crack", "email": "ctm@gmail.com", "password": "xbt3y0b07d0tn3t"}``` |
| POST | ```api/v1/auth/login``` | ```json {"email": "ctm@gmail.com", "password": "xbt3y0b07d0tn3t"}``` |
| GET | ```api/v1/books```| ```?author=Lazarus+Odhiambo,``` ```?search={book_title,}``` ```?sort=id_asc,``` ```?sort=title_desc,``` ```?sort=genre_asc``` ```?limit=10&offset=8``` |
| GET | ```api/v1/books/{ISBN}``` | N/A |
| POST | ```api/v1/books``` | ```json { "title": "my new book", "description": "my new boom description", "genre": "crime-fiction" "isbn": "isxbn","author_id": 1 }``` |
| PUT | ```api/v1/books/{ISBN}``` | Any of the fields ☝️ |
| DELETE | ```api/v1/books/{ISBN}``` | N/A |
| GET | ```api/v1/authors``` | ```?name=Lazarus+Odhiambo,``` ```?sort=id_asc,``` ```?sort=name_asc``` |
| GET | ```api/v1/authors/{author_id}``` | N/A |
| POST | ```api/v1/authors``` | ```json {"name": "Kioshima Botnet Nikusha", "email": "bot@gmail.com", "bio": "Anon"}``` |
| PUT | ```api/v1/authors/{author_id}``` | Any of the fields ☝️ |
| DELETE | ```api/v1/authors/{author_id}``` | N/A |