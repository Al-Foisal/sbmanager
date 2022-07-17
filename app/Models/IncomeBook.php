<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeBook extends Model {
    use HasFactory;

    protected $guarded = [];

    public function incomeBookDetails() {
        return $this->hasMany(IncomeBookDetail::class);
    }
}
