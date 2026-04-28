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
        'gambar1',
        'gambar2',
        'gambar3',
        'deskripsi',
        'harga_awal'
    ];

    public function carStatus(){
        return $this->belongsTo('Auction::class');
    }
}
