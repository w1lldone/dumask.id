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
    public function admin_can_store_users()
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

    /** @test */
    public function admin_can_update_user()
    {
        $this->login();
        $user = User::factory()->create();
        
        $data = [
            'name' => 'new name',
            'email' => $user->email
        ];
        $response = $this->put(route('user.update', $user), $data, [
            'Accept' => 'application/json'
        ]);

        $response->assertOk()->assertJson($data);
    }

    /** @test */
    public function admin_can_delete_users()
    {
        $this->login();
        $user = User::factory()->create();

        $response = $this->delete(route('user.delete', $user));

        $response->assertNoContent();
        $this->assertDeleted($user);
    }
}
