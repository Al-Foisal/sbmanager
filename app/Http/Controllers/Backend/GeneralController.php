<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Consumer;
use App\Models\DigitalPayment;
use App\Models\District;
use App\Models\Shop;
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

    public function getArea($id) {
        $area = Area::where('district_id', $id)->get();

        return json_encode($area);
    }

    public function consumerPayment($link) {

        $data             = [];
        $data['consumer'] = $consumer = DigitalPayment::where('link', $link)->first();
        $shop             = Shop::where('payment_link', $link)->first();

        if (!$consumer && !$shop) {
            return back();
        }

        $data['shop'] = Shop::find($consumer->shop_id)??[];

        return view('consumer-payment', $data);
    }

}
