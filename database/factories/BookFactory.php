<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
*/

$factory->define(App\Book::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph(9),
        'genre' => $faker->word,
        'isbn' => $faker->isbn13,
        'author_id' => 1
    ];
});
