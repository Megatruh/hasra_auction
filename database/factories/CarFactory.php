<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        return [
            'merk' => fake()->randomElement(['Toyota', 'Honda', 'BMW', 'Mercedes-Benz', 'Nissan']),
            'model' => fake()->words(2, true),
            'tahun' => fake()->numberBetween(1995, (int) now()->format('Y')),
            'odometer' => fake()->optional()->numberBetween(5_000, 250_000),
            'mesin' => fake()->optional()->randomElement(['1500cc', '2000cc', '2400cc', '3000cc']),
            'warna' => fake()->optional()->randomElement(['Hitam', 'Putih', 'Abu-abu', 'Silver', 'Merah']),
            'grade' => fake()->optional()->randomElement(['A', 'B', 'C']),
            'gambar1' => null,
            'deskripsi' => fake()->optional()->paragraph(),
            'harga_awal' => fake()->numberBetween(50_000_000, 500_000_000),
        ];
    }
}
