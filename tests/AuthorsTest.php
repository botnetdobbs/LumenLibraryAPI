<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\User;
use Tymon\JWTAuth\JWTGuard;

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
}
