<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\FAQCategory;

class FAQController extends Controller {
    public function FAQCategory() {
        $faq_category = FAQCategory::all();

        return $faq_category;
    }

    public function FAQCategoryDetails($id) {
        $faq = FAQ::where('f_a_q_category_id', $id)->with('faqcategory')->get();

        return $faq;
    }

}
