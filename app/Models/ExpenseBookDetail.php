<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseBookDetail extends Model {
    use HasFactory;

    protected $guarded = [];
    protected $dates   = ['selected_date'];
    public function expenseBook() {
        return $this->belongsTo(ExpenseBook::class);
    }
}
