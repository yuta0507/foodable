<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    private User $loginUser;

    /**
     * Set the currently logged in user for the application.
     */
    public function login()
    {
        $this->loginUser = User::factory()->create([
            'password' => Hash::make($this->getPassword()),
        ]);

        return $this->actingAs($this->loginUser);
    }

    /**
     * Get the instance of login users' User Model
     *
     * @return App\Models\User
     */
    protected function getLoginUser(): User
    {
        return $this->loginUser;
    }

    /**
     * Get test user's password
     *
     * @return string
     */
    protected function getPassword(): string
    {
        return 'test1234';
    }
}
