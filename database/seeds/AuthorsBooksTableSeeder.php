<?php

use Illuminate\Database\Seeder;
use App\Author;
use App\Book;

class AuthorsBooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   Author::truncate();
        
        factory(Author::class, 50)->create()->each(function ($author) {
            $author->books()->save(factory(Book::class)->make());
        });
    }
}
