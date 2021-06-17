<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSearchByEmailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_not_search_users_by_email_if_not_verified()
    {
        $user1 = User::factory()->create([
            'name' => 'Rafa Nadal',
            'email' => 'rafa.nadal@rollandgarros.com',
            'email_verified_at' => null
        ]);

        $this->get('/api/users?filter[email]=' . $user1->email)
            ->assertJsonCount(0);
    }

    /** @test */
    public function can_not_search_users_by_email_if_not_verified_a_year_ago()
    {
        $user1 = User::factory()->create([
            'name' => 'Rafa Nadal',
            'email' => 'rafa.nadal@rollandgarros.com',
            'email_verified_at' => Carbon::today()
        ]);

        $this->get('/api/users?filter[email]=' . $user1->email)
            ->assertJsonCount(0);
    }

    /** @test */
    public function can_search_users_by_email()
    {
        $user1 = User::factory()->create([
            'name' => 'Rafa Nadal',
            'email' => 'rafa.nadal@rollandgarros.com',
            'email_verified_at' => '2020-06-14'
        ]);

        User::factory()->create([
            'name' => 'Stefanos Tsitsipas',
            'email' => 'stef.tsitsipas@rollandgarros.com',
            'email_verified_at' => '2020-06-14'
        ]);

        $response = $this->get('/api/users?filter[email]=' . $user1->email);

        $response->assertJsonCount(1)
            ->assertJson([
                [
                    'id' => $user1->id,
                    'name' => 'Rafa Nadal',
                    'email' => 'rafa.nadal@rollandgarros.com',
                    "email_verified_at" => "2020-06-14T00:00:00.000000Z"
                ]
            ]);
    }
}
