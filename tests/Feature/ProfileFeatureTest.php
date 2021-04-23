<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileFeatureTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function user_can_update_name()
    {
        $this->login();

        $data = ['name' => 'john doe'];
        $response = $this->putJson(route('profile.update'), $data);

        $response->assertOk()
            ->assertJson($data);
    }

    /** @test */
    public function user_can_update_password()
    {
        $password = 'password';
        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);
        $this->login($user);

        $response = $this->putJson(route('profile.update.password'), [
            'old_password' => $password,
            'password' => 'new password',
            'password_confirmation' => 'new password'
        ]);

        $response->assertOk();
        $this->assertTrue(
            Auth::attempt(['email' => $user->email,'password' => 'new password'])
        );
    }

    /** @test */
    public function user_must_submit_old_password_correctly()
    {
        $password = 'password';
        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);
        $this->login($user);

        $response = $this->putJson(route('profile.update.password'), [
            'old_password' => 'wrong password',
            'password' => 'new password',
            'password_confirmation' => 'new password'
        ]);

        $response->assertJsonValidationErrors('old_password');
    }

    /** @test */
    public function user_without_password_is_not_required_to_submit_old_password()
    {
        $password = Hash::make('password');
        $user = User::factory()->create([
            'google_id' => $this->faker->uuid,
            'default_password' => $password,
            'password' => $password,
        ]);
        $this->login($user);

        $response = $this->putJson(route('profile.update.password'), [
            'password' => 'new password',
            'password_confirmation' => 'new password'
        ]);

        $response->assertOk();
        $this->assertTrue(
            Auth::attempt(['email' => $user->email, 'password' => 'new password'])
        );
    }
}
