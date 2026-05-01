<?php

namespace Tests\Feature;

use App\Models\Auction;
use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuctionBidTest extends TestCase
{
    use RefreshDatabase;

    public function test_player_bid_below_opening_price_fails_with_session_error(): void
    {
        /** @var User $player */
        $player = User::factory()->create(['role' => 'player']);

        /** @var Car $car */
        $car = Car::factory()->create([
            'harga_awal' => 100_000_000,
        ]);

        /** @var Auction $auction */
        $auction = Auction::factory()->create([
            'car_id' => $car->id,
            'status' => 'active',
            'current_round' => 1,
            'start_time' => now(),
            'end_time' => now()->addMinute(),
        ]);

        $showUrl = route('auctions.show', $auction->id);

        $response = $this
            ->actingAs($player)
            ->from($showUrl)
            ->post(route('player.auction.bid', $auction->id), [
                'bid_amount' => 99_000_000, // di bawah harga_awal
            ]);

        $response
            ->assertRedirect($showUrl)
            ->assertSessionHas('error', 'Penawaran harus lebih tinggi dari harga saat ini!');

        $this->assertDatabaseCount('bids', 0);
    }

    public function test_player_bid_above_opening_price_is_saved_with_round_number(): void
    {
        /** @var User $player */
        $player = User::factory()->create(['role' => 'player']);

        /** @var Car $car */
        $car = Car::factory()->create([
            'harga_awal' => 100_000_000,
        ]);

        /** @var Auction $auction */
        $auction = Auction::factory()->create([
            'car_id' => $car->id,
            'status' => 'active',
            'current_round' => 1,
            'start_time' => now(),
            'end_time' => now()->addMinute(),
        ]);

        $showUrl = route('auctions.show', $auction->id);

        $response = $this
            ->actingAs($player)
            ->from($showUrl)
            ->post(route('player.auction.bid', $auction->id), [
                'bid_amount' => 110_000_000, // di atas harga_awal
            ]);

        $response
            ->assertRedirect($showUrl)
            ->assertSessionHas('success', 'Berhasil melakukan penawaran!');

        $this->assertDatabaseHas('bids', [
            'auction_id' => $auction->id,
            'user_id' => $player->id,
            'bid_amount' => 110_000_000,
            'round_number' => 1,
        ]);
    }
}
