<?php

namespace Database\Seeders;

use App\Models\Car;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
            'merk' => 'Toyota',
            'model' => 'Supra MK4',
            'odometer' => 120000,
            'tahun' => 1998,
            'grade' => 'A',
            'deskripsi' => 'Kondisi mesin standar pabrik, cat orisinal.',
            'harga_awal' => 500000000,
            'gambar1' => 'supra1.png',
            'mesin' => 'I6-3.0L',
            'warna' => 'Merah',],
            [
            'merk' => 'Honda',
            'model' => 'Civic EG6',
            'odometer' => 150000,
            'tahun' => 1995,
            'grade' => 'B',
            'gambar1' => 'civic-eg6.png',
            'deskripsi' => 'Mesin sudah pernah di-tune up, cat masih orisinal.',
            'harga_awal' => 150000000,
            'mesin' => 'I4-1.6L',
            'warna' => 'Hitam',
            ],
            [
            'merk' => 'Nissan',
            'model' => 'Skyline R34',
            'odometer' => 90000,
            'tahun' => 2002,
            'grade' => 'A',
            'gambar1' => 'skyline-r34.png',
            'deskripsi' => 'Kondisi mesin sangat baik, cat orisinal.',
            'harga_awal' => 800000000,
            'mesin' => 'I6-2.5L Turbo',
            'warna' => 'Biru',
            ],
            [
            'merk' => 'Mitsubishi',
            'model' => 'Lancer Evolution VI',
            'odometer' => 110000,
            'tahun' => 1999,
            'gambar1' => 'lancer-evo6.png',
            'grade' => 'B',
            'deskripsi' => 'Mesin sudah pernah di-tune up, cat masih orisinal.',
            'harga_awal' => 300000000,
            'mesin' => 'I4-2.0L Turbo',
            'warna' => 'Putih',
            ],
            [
            'merk' => 'Mazda',
            'model' => 'RX-7 FD',
            'odometer' => 80000,
            'tahun' => 1995,
            'grade' => 'A',
            'deskripsi' => 'Kondisi mesin sangat baik, cat orisinal.',
            'harga_awal' => 600000000,
            'mesin' => 'Rotary-1.3L Twin Turbo',
            'gambar1' => 'rx-7.png',
            'warna' => 'Kuning',
            ],
            [
            'merk' => 'Subaru',
            'model' => 'Impreza WRX STI',
            'odometer' => 100000,
            'tahun' => 2004,
            'grade' => 'B',
            'deskripsi' => 'Mesin sudah pernah di-tune up, cat masih orisinal.',
            'harga_awal' => 350000000,
            'mesin' => 'H4-2.0L Turbo',
            'gambar1' => 'impreza-wrx-sti.png',
            'warna' => 'Hijau',
            ],
            [
            'merk' => 'Nissan',
            'model' => 'Fairlady Z Z33',
            'odometer' => 130000,
            'tahun' => 2003,
            'gambar1' => 'fairlady-z-z33.png',
            'grade' => 'B',
            'deskripsi' => 'Mesin sudah pernah di-tune up, cat masih orisinal.',
            'harga_awal' => 250000000,
            'mesin' => 'V6-3.5L',
            'warna' => 'Abu-abu',
            ],
            [
            'merk' => 'Toyota',
            'model' => 'AE86',
            'odometer' => 140000,
            'tahun' => 1986,
            'grade' => 'A',
            'deskripsi' => 'Kondisi mesin sangat baik, cat orisinal.',
            'harga_awal' => 400000000,
            'gambar1' => 'ae86.png',
            'mesin' => 'I4-1.6L',
            'warna' => 'Putih-Hitam',
            ],
            [
            'merk' => 'Honda',
            'model' => 'NSX NA1',
            'odometer' => 70000,
            'tahun' => 1991,
            'grade' => 'A',
            'gambar1' => 'nsx.png',
            'deskripsi' => 'Kondisi mesin sangat baik, cat orisinal.',
            'harga_awal' => 900000000,
            'mesin' => 'V6-3.0L',
            'warna' => 'Merah',
            ],
            [
            'merk' => 'Mitsubishi',
            'model' => '3000GT VR-4',
            'odometer' => 90000,
            'tahun' => 1994,
            'grade' => 'B',
            'deskripsi' => 'Mesin sudah pernah di-tune up, cat masih orisinal.',
            'harga_awal' => 200000000,
            'mesin' => 'V6-3.0L Twin Turbo',
            'gambar1' => '3000gt-vr4.png',
            'warna' => 'Biru',
            ],
            [
            'merk' => 'Mazda',
            'model' => 'MX-5 NA',
            'odometer' => 160000,
            'tahun' => 1990,
            'grade' => 'B',
            'deskripsi' => 'Mesin sudah pernah di-tune up, cat masih orisinal.',
            'harga_awal' => 100000000,
            'gambar1' => 'mx-5na.png',
            'mesin' => 'I4-1.6L',
            'warna' => 'Merah',
            ],
            [
            'merk' => 'Subaru',
            'model' => 'Legacy B4 RSK',
            'odometer' => 120000,
            'gambar1' => 'legacy-b4-rsk.png',
            'tahun' => 2000,
            'grade' => 'B',
            'deskripsi' => 'Mesin sudah pernah di-tune up, cat masih orisinal.',
            'harga_awal' => 150000000,
            'mesin' => 'H4-2.0L Turbo',
            'warna' => 'Hitam',
            ]
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
