<?php

namespace Database\Factories;

use App\Models\Auction;
use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Auction>
 */
class AuctionFactory extends Factory
{
    protected $model = Auction::class;

    public function definition(): array
    {
        $start = now();

        return [
            'car_id' => Car::factory(),
            'current_round' => 1,
            'start_time' => $start,
            'end_time' => (clone $start)->addMinute(),
            'status' => 'pending',
        ];
    }

    public function active(): static
    {
        return $this->state(function () {
            $start = now();

            return [
                'status' => 'active',
                'start_time' => $start,
                'end_time' => (clone $start)->addMinute(),
                'current_round' => 1,
            ];
        });
    }
}
