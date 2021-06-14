<?php

namespace Tests\Feature\Models;

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
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

    /** @test */
    public function it_determines_user_has_no_password()
    {
        $password = Hash::make('password');
        $user = User::factory()->create([
            'google_id' => $this->faker->uuid,
            'default_password' => $password,
            'password' => $password,
        ]);

        $this->assertTrue($user->has_no_password);
    }

    /** @test */
    public function it_has_many_reports()
    {
        $user = User::factory()->create();

        $report = Report::factory(5)->create([
            'reporter_id' => $user->id,
        ]);

        $this->assertCount(5, $user->reports);
    }
}
