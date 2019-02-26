<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ProfileTest extends TestCase
{
    public function test_update_profile_with_no_data_will_failed()
    {
        $user = User::first();

        $response = $this->actingAs($user, 'api')->json('PUT', '/api/profile/' . $user->id);

        $response->assertStatus(422);
    }

    public function test_update_profile()
    {
        $user = User::first();

        $postData = [
            'name' => 'Dani Dan',
            'email' => $user->email,
            'phone' => $user->phone,
        ];

        $response = $this->actingAs($user, 'api')->json('PUT', '/api/profile/' . $user->id, $postData);

        $response->assertStatus(200);

        $user = User::first();
        $this->assertEquals($postData['name'], $user->name);
    }

    /**
     * @test
     */

    public function change_password_with_no_data_will_failed()
    {
        $user = User::first();

        $response = $this->actingAs($user, 'api')->json('PUT', '/api/profile/' . $user->id . '/change-password');

        $response->assertStatus(422);
    }

    /**
     * @test
     */

    public function change_password_with_unmatched_old_and_new_password()
    {
        $user = User::first();

        $postData = [
            'password' => 'password',
            'password_confirmation' => 'password2'
        ];

        $response = $this->actingAs($user, 'api')->json('PUT', '/api/profile/' . $user->id . '/change-password', $postData);

        $response->assertStatus(422);
    }

    /**
     * @test
     */

    public function change_password()
    {
        $user = User::first();

        $postData = [
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $response = $this->actingAs($user, 'api')->json('PUT', '/api/profile/' . $user->id . '/change-password', $postData);

        $response->assertStatus(200);
    }
}
