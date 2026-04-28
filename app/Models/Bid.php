<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Bid extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'bid_amount',
        'user_id',
        'auction_id',
    ];

    public function auction()
    {
        return $this->hasOne(Auction::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
