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
        // Buat Mobil Contoh
        $car = Car::create([
            'merk' => 'Toyota',
            'model' => 'Supra MK4',
            'odometer' => 120000,
            'tahun' => 1998,
            'grade' => 'A',
            'deskripsi' => 'Kondisi mesin standar pabrik, cat orisinal.',
            'harga_awal' => 500000000,
        ]);

        // Buka Lelangnya
        Auction::create([
            'car_id' => $car->id,
            'start_time' => now(),
            'end_time' => now()->addDays(3),
            'status' => 'active',
        ]);
    }
}
