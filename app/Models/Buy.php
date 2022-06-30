<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function buyProduct() {
        return $this->hasMany(BuyProduct::class);
    }

    public function getButtonColorAttribute() {

        if ($this->payment_method === 'Cash') {
            return 'primary';
        } elseif ($this->payment_method === 'Bank Check') {
            return 'success';
        } elseif ($this->payment_method === 'Due') {
            return 'danger';
        } elseif ($this->payment_method === 'Personal Payment') {
            return 'info';
        } elseif ($this->payment_method === 'Quick Sell') {
            return 'warning';
        }

    }
}
