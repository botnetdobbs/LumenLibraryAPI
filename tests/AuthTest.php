<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\User;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function userCanCreateAnAccount()
    {
        $user = ['name' => 'Test User', 'email' => 'testuser@email.com', 'password' => 'xbt3yboebt69nsec'];

        $response = $this->post('/api/v1/auth/register', $user);

        $response->assertResponseStatus(201);
    }

    /**
     * @test
     *
     * @return void
     */
    public function userCanLogin()
    {
        $user = factory(User::class)->create();
        $credentials = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $response = $this->post('/api/v1/auth/login', $credentials);

        $response->assertResponseStatus(200);
    }
}
