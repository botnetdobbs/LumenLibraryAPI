[![CircleCI](https://circleci.com/gh/botnetdobbs/LumenLibraryAPI.svg?style=svg)](https://circleci.com/gh/botnetdobbs/LumenLibraryAPI)
[![Maintainability](https://api.codeclimate.com/v1/badges/b2b6b6e77d685a07c408/maintainability)](https://codeclimate.com/github/botnetdobbs/LumenLibraryAPI/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/b2b6b6e77d685a07c408/test_coverage)](https://codeclimate.com/github/botnetdobbs/LumenLibraryAPI/test_coverage)


| Method | Endpoint | Params |
| ------ | ------ | ------- |
| POST | ```api/v1/auth/register``` | ```json {"name": "Imega Crack", "email": "ctm@gmail.com", "password": "xbt3y0b07d0tn3t"}``` |
| POST | ```api/v1/auth/login``` | ```json {"email": "ctm@gmail.com", "password": "xbt3y0b07d0tn3t"}``` |
| GET | ```api/v1/books```| ```?author=Lazarus+Odhiambo,``` ```?title={book_title,}``` ```?sort=id_asc,``` ```?sort=title_desc,``` ```?sort=genre_asc``` |
| GET | ```api/v1/books/{ISBN}``` | N/A |
| POST | ```api/v1/books``` | ```json { "title": "my new book", "description": "my new boom description", "genre": "crime-fiction" "isbn": "isxbn","author_id": 1 }``` |
| PUT | ```api/v1/books/{ISBN}``` | Any of the fields ☝️ |
| DELETE | ```api/v1/books/{ISBN}``` | N/A |
| GET | ```api/v1/authors``` | ```?name=Lazarus+Odhiambo,``` ```?sort=id_asc,``` ```?sort=name_asc``` |
| GET | ```api/v1/authors/{author_id}``` | N/A |
| POST | ```api/v1/authors``` | ```json {"name": "Kioshima Botnet Nikusha", "email": "bot@gmail.com", "bio": "Anon"}``` |
| PUT | ```api/v1/authors/{author_id}``` | Any of the fields ☝️ |
| DELETE | ```api/v1/authors/{author_id}``` | N/A |