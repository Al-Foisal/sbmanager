<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model {
    use HasFactory;
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function subcategory() {
        return $this->belongsTo(Subcategory::class);
    }

    public function orderProduct() {
        return $this->hasMany(OrderProduct::class);
    }

    public function sellProduct() {
        return $this->hasOne(OrderProduct::class)->latest();
    }

    public function buyProduct() {
        return $this->hasOne(buyProduct::class)->latest();
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value) . rand();
    }

}
