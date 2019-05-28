<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\User;
use App\Author;

class AuthorsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function userCanAddAuthor()
    {
        $author = ['name' => 'test author', 'bio' => 'A Kenyan author and a music enthusiast. Plays violin, Piano and Drums.', 'email' => 'test.author@email.com'];
        $user = factory(User::class)->create();
        $this->be($user);
        $response = $this->post('/api/v1/authors', $author);
        $response->assertResponseStatus(201);

    }

    /**
     * @test
     *
     * @return void
     */
    public function nonAuthUserCannotAddAuthor()
    {
        $author = ['name' => 'test author', 'bio' => 'A Kenyan author and a music enthusiast. Plays violin, Piano and Drums.', 'email' => 'test.author@email.com'];
        $response = $this->post('/api/v1/authors', $author);
        $response->assertResponseStatus(401);
    }

    /**
     * @test
     *
     * @return void
     */
    public function userCanViewAllAuthors()
    {
        factory(Author::class, 8)->create();

        $response = $this->get('/api/v1/authors');
        
        $response->assertResponseStatus(200);
    }

    /**
     * @test
     *
     * @return void
     */
    public function anyUserCanViewSingleAuthor()
    {
        $author = factory(Author::class)->create();

        $response = $this->get("/api/v1/authors/{$author->id}");

        $response->assertResponseStatus(200);
    }

    /**
     * @test
     *
     * @return void
     */
    public function returns404OnAuthorNotFound()
    {
        $response = $this->get("/api/v1/authors/9");

        $response->assertResponseStatus(404);
    }
}
