<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\DigitalPayment;
use App\Models\District;
use App\Models\Division;
use App\Models\Shop;
use App\Models\ShopType;

class GeneralController extends Controller {
    public function shopType() {
        $shop = ShopType::all();

        return $shop;
    }

    public function division() {
        $division = Division::with('districts')->get();

        return $division;
    }

    public function district() {
        $district = District::with('division')->get();

        return $district;
    }

    public function area() {
        $area = Area::with('district', 'division')->get();

        return $area;
    }

    public function districtByDivision($division_id) {
        $district = District::where('division_id', $division_id)->get();

        return $district;
    }

    public function areaByDistrict($discrict_id) {
        $area = Area::where('discrict_id', $discrict_id)->get();

        return $area;
    }

    public function consumerPayment($link) {

        $data             = [];
        $data['consumer'] = $consumer = DigitalPayment::where('link', $link)->first();
        $shop             = Shop::where('payment_link', $link)->first();

        if (!$consumer && !$shop) {
            return back();
        }

        $data['shop'] = Shop::find($consumer->shop_id)??[];

        return $data;
    }
}
