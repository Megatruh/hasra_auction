<?php

namespace Database\Seeders;

use App\Models\Auction;
use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //ambil data mobil data semua mobil untuk di lelang
        $cars = Car::all();

        // Buka Lelangnya
        foreach($cars as $car){
            Auction::create([
                'car_id' => $car->id,
                'status' => 'pending',
                'start_time' => now(),
                'end_time' => now()->addDays(3),
            ]);
        }
    }
}
