<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_get_all_users()
    {
        $this->login();
        
        User::factory(5)->create();
        $response = $this->get(
            route('user.index')
        , [
            'Accept' => 'application/json'
        ]);

        $response->assertOk();
    }

    /** @test */
    public function admi_can_store_users()
    {
        $this->login();

        $user = User::factory()->make();

        $response = $this->post(route('user.store'), [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertCreated();
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email
        ]);
    }
}
