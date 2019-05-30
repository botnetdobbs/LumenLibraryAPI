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

    /**
     * @test
     *
     * @return void
     */
    public function authUserCanEditAuthor()
    {
        $author = factory(Author::class)->create();
        $user = factory(User::class)->create();
        $this->be($user);

        $response = $this->put("/api/v1/authors/{$author->id}", ["name" => "Updated Name"]);
        $authorUpdate = $this->get("/api/v1/authors/{$author->id}");

        $response->assertResponseStatus(200);
        $authorUpdate->seeJson(["name" => "Updated Name"]);
    }

    /**
     * @test
     *
     * @return void
     */
    public function editingNonExistingAuthorReturns404()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $response = $this->put("/api/v1/authors/{3}", ["name" => "Updated Name"]);

        $response->assertResponseStatus(404);
    }

    /**
     * @test
     *
     * @return void
     */
    public function authUserCanDeleteAuthor()
    {
        $author = factory(Author::class)->create();
        $user = factory(User::class)->create();
        $this->be($user);

        $response = $this->delete("/api/v1/authors/{$author->id}");

        $response->assertResponseStatus(204);
    }

    /**
     * @test
     *
     * @return void
     */
    public function deletingNonExistingAuthorReturns404()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $response = $this->delete("/api/v1/authors/9");

        $response->assertResponseStatus(404);
    }

    /**
     * @test
     *
     * @return void
     */
    public function userCanSearchForAnAuthor()
    {
        $author = factory(Author::class)->create();

        $response = $this->get("/api/v1/authors?name={$author->name}");

        $response->assertResponseStatus(200);
    }

    /**
     * @test
     *
     * @return void
     */
    public function userCanSortAuthors()
    {
        factory(Author::class, 3)->create();

        $response = $this->get("/api/v1/authors?sort=name_asc");

        $response->assertResponseStatus(200);
    }

    /**
     * @test
     *
     * @return void
     */
    public function userCanUseLimitAndOffsetToQueryAuthors()
    {
        factory(Author::class, 50)->create();

        $response = $this->get("/api/v1/authors?offset=8&limit=10");

        $response->assertResponseStatus(200);
    }
}
