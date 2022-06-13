<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Consumer;
use App\Models\District;
use App\Models\Division;
use App\Models\Subcategory;

class GeneralController extends Controller {
    public function getSubcategory($id) {
        $subcategory = Subcategory::where('category_id', $id)->where('status', 1)->get();

        return json_encode($subcategory);
    }

    public function getConsumer() {
        $consumer = Consumer::where('shop_id', SID())->get();

        return json_encode($consumer);
    }

    public function getDistrict($id) {
        $district = District::where('division_id', $id)->get();

        return json_encode($district);
    }
}
