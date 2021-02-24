<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_a_user()
    {
        $data = [
            'email' => 'email@example.com',
            'password' => 'password',
        ];
        $this->post('/api/users', $data)
            ->assertStatus(201)
            ->assertJsonStructure(['id', 'name', 'email'])
            ->assertDontSee('password');
    }

    /** @test */
    public function can_get_a_user()
    {
        $user = User::factory()->create();
        $this->get("/api/users/$user->id")
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
            ])
            ->assertDontSee('password');
    }

    /** @test */
    public function can_get_a_list_of_users()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $this->get('/api/users')
            ->assertStatus(200)
            ->assertJsonFragment(['id' => $user1->id])
            ->assertJsonFragment(['id' => $user2->id]);
    }

    /** @test */
    public function can_get_users_created_after_a_specific_date()
    {
        $user1 = User::factory()->create(['created_at' => Carbon::now()->subYears(2)]);
        $user2 = User::factory()->create(['created_at' => Carbon::now()]);
        $this->get('/api/users?filter[created_after]=' . Carbon::yesterday()->toDateString())
            ->assertStatus(200)
            ->assertJsonFragment(['id' => $user2->id])
            ->assertJsonMissing(['id' => $user1->id]);
    }

    /** @test */
    public function verified_users_can_get_discounts()
    {
        $user = User::factory()->create(['email_verified_at' => '2021-01-01']);
        $this->assertTrue($user->can_get_discounts);
    }

    /** @test */
    public function unverified_users_can_not_get_discounts()
    {
        $user = User::factory()->create(['email_verified_at' => null]);
        $this->assertFalse($user->can_get_discounts);
    }

    // TODO: Make it possible to search for users by email. Should return a list of matches. Add a new test for this.
}
