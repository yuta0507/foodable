<?php

namespace Tests\Unit\Controllers\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticatedSessionControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test to view the login page.
     */
    public function testCreate()
    {
        $response = $this->get('/login');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('Sign In');
        $this->assertGuest();
    }

    /**
     * Test case in access the home page without login.
     */
    public function testAccessHomeByGuest()
    {
        $response = $this->get('/');

        $response->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/login');

        $this->assertGuest();
    }

    /**
     * Test the login process.
     */
    public function testStore()
    {
        $this->assertGuest();

        $user = User::factory()->create(['email' => 'test@example.com', 'password' => Hash::make('test1234')]);

        $response = $this->post(route('login'), ['email' => $user->email, 'password' => 'test1234']);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect(RouteServiceProvider::HOME);
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test the logout precess.
     */
    public function testDestroy()
    {
        $this->login();

        $this->assertAuthenticatedAs($this->getLoginUser());

        $response = $this->post(route('logout'));

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
