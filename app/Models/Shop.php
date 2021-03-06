<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model {
    use HasFactory;
    protected $guarded = [];
    protected $dates   = ['end_date'];
    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function shopType() {
        return $this->belongsTo(ShopType::class);
    }

    public function division() {
        return $this->belongsTo(Division::class);
    }

    public function district() {
        return $this->belongsTo(District::class);
    }

    public function area() {
        return $this->belongsTo(Area::class);
    }
}
