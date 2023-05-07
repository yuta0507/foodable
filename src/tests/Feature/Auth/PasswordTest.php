<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test to update the password
     */
    public function testUpdate()
    {
        $this->login();

        $this->assertAuthenticatedAs($this->getLoginUser());

        $newPassword = '1234567890';

        $response = $this->patch(route('password.update'), [
            'current_password' => $this->getPassword(),
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertRedirect('/profile');

        $this->assertTrue(Hash::check($newPassword, $this->getLoginUser()->password));
    }
}
