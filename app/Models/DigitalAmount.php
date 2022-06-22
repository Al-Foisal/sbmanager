<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalAmount extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $dates   = ['last_withdraw'];
    public function shop() {
        return $this->belongsTo(Shop::class);
    }
}
