<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model {
    use HasFactory;
    protected $guarded = [];

    public function faqcategory() {
        return $this->belongsTo(FAQCategory::class, 'f_a_q_category_id', 'id');
    }
}
