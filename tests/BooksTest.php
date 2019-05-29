<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Book;
use App\Author;

class BooksTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function userCanViewAllExistingBooks()
    {
        //Relationship: Author has many books
        factory(Author::class)->create();
        factory(Book::class, 8)->create();

        $response = $this->get("/api/v1/books");
        
        $response->assertResponseStatus(200);
    }
}
