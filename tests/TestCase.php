<?php

namespace Tests;

use App\Models\User;
use Carbon\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Current User
     *
     * @var \App\Models\User
     */
    public $user;

    public function login(User $user = null)
    {
        if (!$user) {
            $user = User::factory()->superadmin()->create();
        }

        $this->user = $user;

        $this->actingAs($user);
    }
}
