<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Auction extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'car_id',
        'status',
        'start_time',
        'end_time',
        'current_round',
    ];
    protected $casts = [
        'start_time'=>'datetime',
        'end_time'=>'datetime',
    ];

    public function bids(){
        return $this->hasMany(Bid::class);
    }

    public function car(){
        return $this->belongsTo(Car::class, 'car_id');
    }

    public function highestBid() {
        return $this->hasOne(Bid::class)->latestOfMany('bid_amount');
    }
}
