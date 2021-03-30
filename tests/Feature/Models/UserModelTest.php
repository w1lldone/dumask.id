<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function user_can_be_created_using_factory()
    {
        $user = User::factory()->create();

        $this->assertDatabaseHas('users', [
            'name' => $user->name
        ]);
    }

    /** @test */
    public function it_can_check_user_permissions()
    {
        /** @var User */
        $user = User::factory()->create([
            'permissions' => User::$permissions
        ]);

        $permission = $this->faker->randomElement(User::$permissions);
        
        $this->assertTrue($user->hasPermission($permission));
    }
}
