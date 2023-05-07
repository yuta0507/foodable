<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test to show the profile edit page
     */
    public function testShowEditPage()
    {
        $this->login();

        $this->assertAuthenticatedAs($this->getLoginUser());

        $response = $this->get('/profile');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee('Profile Settings');
    }

    /**
     * Test to update the profile
     */
    public function testUpdate()
    {
        $this->login();

        $this->assertAuthenticatedAs($this->getLoginUser());

        $data = [
            'name' => 'Test User Update',
            'email' => 'update.test@example.com',
        ];

        $response = $this->patch(route('profile.update'), $data);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/profile');

        $this->assertDatabaseHas('users', $data);
    }

    /**
     * Test to delete the user
     */
    public function testDestroy()
    {
        $this->login();

        $this->assertAuthenticatedAs($this->getLoginUser());

        $userId = $this->getLoginUser()->id;

        $response = $this->delete(route('profile.destroy'), [
            'password' => $this->getPassword(),
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/login');

        $this->assertDatabaseMissing('users', ['id' => $userId]);
        $this->assertGuest();
    }
}
