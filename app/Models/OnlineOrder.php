<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineOrder extends Model {
    use HasFactory;
    protected $guarded = [];
    public function division() {
        return $this->belongsTo(Division::class);
    }

    public function district() {
        return $this->belongsTo(District::class);
    }

    public function area() {
        return $this->belongsTo(Area::class);
    }

    public function onlineOrderProducts() {
        return $this->hasMany(OnlineOrderProduct::class);
    }

    public function getOrderStatusAttribute() {
        $status = $this->status;

        if ($status == 1) {
            return 'Pending';
        } elseif ($status == 2) {
            return 'Processing';
        } elseif ($status == 3) {
            return 'Confirm';
        } elseif ($status == 4) {
            return 'Shipping';
        } elseif ($status == 5) {
            return 'Delivered';
        }

    }

}
