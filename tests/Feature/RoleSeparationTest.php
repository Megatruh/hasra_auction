<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleSeparationTest extends TestCase
{
    use RefreshDatabase;

    public function test_player_cannot_access_host_routes(): void
    {
        /** @var User $player */
        $player = User::factory()->create(['role' => 'player']);

        $response = $this->actingAs($player)->get(route('host.dashboard'));

        $response->assertForbidden();
    }

    public function test_host_cannot_access_player_routes(): void
    {
        /** @var User $host */
        $host = User::factory()->create(['role' => 'host']);

        $response = $this->actingAs($host)->get(route('player.dashboard'));

        $response->assertForbidden();
    }

    public function test_host_can_access_host_dashboard(): void
    {
        /** @var User $host */
        $host = User::factory()->create(['role' => 'host']);

        $response = $this->actingAs($host)->get(route('host.dashboard'));

        $response->assertOk();
    }
}
