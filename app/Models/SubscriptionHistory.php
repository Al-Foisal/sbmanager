<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionHistory extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $dates   = ['starting_from', 'ending_at'];
    public function subscription() {
        return $this->belongsTo(Subscription::class);
    }

    public function shop() {
        return $this->belongsTo(Shop::class);
    }
}
