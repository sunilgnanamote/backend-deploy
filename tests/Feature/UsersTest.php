<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_a_list_of_users()
    {
        \App\Models\User::factory()->times(3)->create();

        $this->json('get', '/api/users')
            ->assertOk()
            ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_create_a_new_user()
    {
        $this->json('post', '/api/users', ['name' => 'The Stash'])
            ->assertCreated()
            ->assertJsonFragment([
                'name' => 'The Stash',
                'email' => 'the-stash@example.com'
            ]);
    }

    /** @test */
    public function it_validates_requests()
    {
        $this->withExceptionHandling();

        $this->json('post', '/api/users', ['name' => null])
            ->assertJsonValidationErrorFor('name');
    }
}
