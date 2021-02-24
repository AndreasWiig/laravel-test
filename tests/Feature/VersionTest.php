<?php

namespace Tests\Feature;

use Tests\TestCase;

class VersionTest extends TestCase
{
    /** @test */
    public function can_get_version()
    {
        $this->get('/api/version')->assertStatus(200);
    }

    /** @test */
    public function version_is_defined_in_an_environment_variable()
    {
        $this->get('/api/version')
            ->assertStatus(200)
            ->assertJsonFragment([
                'version' => env('VERSION'),
            ]);
    }
}
