<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class RegisteredUserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test to show the new user's registration form
     */
    public function testShowRegistrationForm()
    {
        $response = $this->get('/register');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('Register a new membership');
        $this->assertGuest();
    }

    /**
     * Test to register a new user
     */
    public function testRegister()
    {
        $password = '1234567890';

        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ];

        $response = $this->post(
            route('register'),
            array_merge(
                $data,
                [
                    'password' => $password,
                    'password_confirmation' => $password,
                ]
            )
        );

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(RouteServiceProvider::HOME);

        $this->assertDatabaseHas('users', $data);
    }
}
