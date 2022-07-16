<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Buy;
use App\Models\Category;
use App\Models\DigitalPayment;
use App\Models\District;
use App\Models\Division;
use App\Models\ExpenseBookDetail;
use App\Models\OnlineOrder;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopType;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller {
    public function category() {
        $category = Category::where('status', 1)->get();

        return $category;
    }

    public function subcategory($id) {
        $sub = Subcategory::where('category_id', $id)->where('status', 1)->get();

        return $sub;
    }

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

    public function areaByDistrict($district_id) {
        $area = Area::where('district_id', $district_id)->get();

        return $area;
    }

    public function consumerPayment($link) {

        $data             = [];
        $data['consumer'] = $consumer = DigitalPayment::where('link', $link)->first();
        $shop             = Shop::where('payment_link', $link)->first();

        if (!$consumer && !$shop) {
            return back();
        }

        $data['shop'] = Shop::find($consumer->shop_id) ?? [];

        return $data;
    }

    public function consumerOrders($shop_id) {
        $data             = [];
        $data['consumer'] = DB::table('consumers')
            ->where('consumers.shop_id', $shop_id)
            ->join('orders', 'consumers.id', 'orders.consumer_id')
            ->join('order_products', 'orders.id', 'order_products.order_id')
            ->groupBy('orders.consumer_id')
            ->selectRaw('consumers.id, consumers.name as consumerName, sum(orders.subtotal) as amount, count(orders.id) as totalOrder, sum(order_products.quantity) as quantity')
            ->orderBy('quantity', 'desc')
            ->paginate(500);

        return $data;
    }

    public function employeeOrders($shop_id) {
        $data             = [];
        $data['employee'] = DB::table('employees')
            ->where('employees.shop_id', $shop_id)
            ->join('orders', 'employees.id', 'orders.employee_id')
            ->join('order_products', 'orders.id', 'order_products.order_id')
            ->groupBy('orders.employee_id')
            ->selectRaw('employees.id, employees.name as employeeName, sum(orders.subtotal) as amount, count(orders.id) as totalOrder, sum(order_products.quantity) as quantity')
            ->orderBy('quantity', 'desc')
            ->paginate(500);

        return $data;
    }

    public function supplierReport($shop_id) {
        $data             = [];
        $data['supplier'] = DB::table('suppliers')
            ->where('suppliers.shop_id', $shop_id)
            ->join('buys', 'suppliers.id', 'buys.supplier_id')
            ->join('buy_products', 'buys.id', 'buy_products.buy_id')
            ->groupBy('buys.supplier_id')
            ->selectRaw('suppliers.id, suppliers.name as supplierName, sum(buys.subtotal) as amount, count(buys.id) as totalOrder, sum(buy_products.quantity) as quantity')
            ->orderBy('quantity', 'desc')
            ->paginate(500);

        return $data;
    }

    public function stockReport($shop_id) {
        $data            = [];
        $data['product'] = Product::where('shop_id', $shop_id)
            ->select(['id', 'name', 'quantity'])
            ->with('sellProduct', 'buyProduct')
            ->get();

        return $data;

    }

    public function productReport($shop_id) {
        $product = Product::where('shop_id', $shop_id)
            ->select(['id', 'name'])
            ->withSum('orderProduct', 'quantity')
            ->withSum('orderProduct', 'price')
            ->get();

        return $product;
    }

    public function plReport($shop_id) {
        $data          = [];
        $date_time     = request()->date_time ?? date("Y-m-d");
        $selected_date = Carbon::parse($date_time)->format('d-m-Y');

        $data['sell'] = Order::where('shop_id', $shop_id)->whereMonth('created_at', $selected_date)->sum('subtotal');
        $data['cost'] = Buy::where('shop_id', $shop_id)->whereMonth('created_at', $selected_date)->sum('subtotal');

        $data['other_sell'] = OnlineOrder::where('shop_id', $shop_id)->whereMonth('created_at', $selected_date)->where('status', 5)->sum('subtotal');
        $data['other_cost'] = ExpenseBookDetail::where('shop_id', $shop_id)->whereMonth('created_at', $selected_date)->sum('amount');

        $data['total'] = ($data['sell'] + $data['other_sell']) - ($data['cost'] + $data['other_cost']);

        return $data;
    }

}
