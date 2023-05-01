<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    private User $loginUser;

    /**
     * Set the currently logged in user for the application.
     */
    public function login()
    {
        $this->loginUser = User::factory()->create();

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
}
