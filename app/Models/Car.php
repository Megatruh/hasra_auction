<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Car extends Model
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'merk',
        'model',
        'tahun',
        'odometer',
        'grade',
        'mesin',
        'warna',
        'gambar1',
        'gambar2',
        'gambar3',
        'deskripsi',
        'harga_awal'
    ];

    public function carStatus(){
        // A car can be attached to one auction session via auctions.car_id
        return $this->hasOne(Auction::class, 'car_id');
    }
}
