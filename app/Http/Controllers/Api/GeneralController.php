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
use App\Models\Supplier;
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
        $data     = [];
        $supplier = Supplier::where('shop_id', $shop_id);

        if (request()->type == 1) {
            $date     = Carbon::parse(request()->selected_date)->format('Y-m-d');
            $supplier = $supplier->whereDate('created_at', $date);
        } elseif (request()->type == 2) {
            $year     = Carbon::parse(request()->selected_date)->format('Y');
            $month    = Carbon::parse(request()->selected_date)->format('m');
            $supplier = $supplier->whereYear('created_at', $year)->whereMonth('created_at', $month);
        } elseif (request()->type == 3) {
            $date_from = Carbon::parse(request()->date_from)->format('Y-m-d');
            $date_to   = Carbon::parse(request()->date_to)->format('Y-m-d');
            $supplier  = $supplier->whereBetween('created_at', [$date_from . " 00:00:00", $date_to . " 23:59:59"]);
        } elseif (request()->type == 4) {
            $date     = Carbon::parse(request()->selected_date)->format('Y-m-d');
            $supplier = $supplier->whereYear('created_at', $date);
        }

        $data['supplier'] = $supplier->with('buy.buyProduct')
            ->get();

        return $data;
    }

    public function stockReport($shop_id) {
        $data    = [];
        $product = Product::where('shop_id', $shop_id);

        if (request()->type == 1) {
            $date    = Carbon::parse(request()->selected_date)->format('Y-m-d');
            $product = $product->whereDate('created_at', $date);
        } elseif (request()->type == 2) {
            $year    = Carbon::parse(request()->selected_date)->format('Y');
            $month   = Carbon::parse(request()->selected_date)->format('m');
            $product = $product->whereYear('created_at', $year)->whereMonth('created_at', $month);
        } elseif (request()->type == 3) {
            $date_from = Carbon::parse(request()->date_from)->format('Y-m-d');
            $date_to   = Carbon::parse(request()->date_to)->format('Y-m-d');
            $product   = $product->whereBetween('created_at', [$date_from . " 00:00:00", $date_to . " 23:59:59"]);
        } elseif (request()->type == 4) {
            $date    = Carbon::parse(request()->selected_date)->format('Y-m-d');
            $product = $product->whereYear('created_at', $date);
        }

        $data['product'] = $product->select(['id', 'name', 'quantity'])
            ->with('sellProduct', 'buyProduct')
            ->get();

        return $data;

    }

    public function productReport($shop_id) {
        $product = Product::where('shop_id', $shop_id);

        if (request()->type == 1) {
            $date    = Carbon::parse(request()->selected_date)->format('Y-m-d');
            $product = $product->whereDate('created_at', $date);
        } elseif (request()->type == 2) {
            $year    = Carbon::parse(request()->selected_date)->format('Y');
            $month   = Carbon::parse(request()->selected_date)->format('m');
            $product = $product->whereYear('created_at', $year)->whereMonth('created_at', $month);
        } elseif (request()->type == 3) {
            $date_from = Carbon::parse(request()->date_from)->format('Y-m-d');
            $date_to   = Carbon::parse(request()->date_to)->format('Y-m-d');
            $product   = $product->whereBetween('created_at', [$date_from . " 00:00:00", $date_to . " 23:59:59"]);
        } elseif (request()->type == 4) {
            $date    = Carbon::parse(request()->selected_date)->format('Y-m-d');
            $product = $product->whereYear('created_at', $date);
        }

        $product = $product->select(['id', 'name'])
            ->withSum('orderProduct', 'quantity')
            ->withSum('orderProduct', 'price')
            ->get();

        return $product;
    }

    public function plReport($shop_id) {
        $data = [];

        if (request()->type == 1) {
            $date = Carbon::parse(request()->selected_date)->format('Y-m-d');

            $data['sell'] = Order::where('shop_id', $shop_id)->whereDate('created_at', $date)->sum('subtotal');
            $data['cost'] = Buy::where('shop_id', $shop_id)->whereDate('created_at', $date)->sum('subtotal');

            $data['other_sell'] = OnlineOrder::where('shop_id', $shop_id)->whereDate('created_at', $date)->where('status', 5)->sum('subtotal');
            $data['other_cost'] = ExpenseBookDetail::where('shop_id', $shop_id)->whereDate('created_at', $date)->sum('amount');

            $order        = Order::where('shop_id', $shop_id)->whereDate('created_at', $date)->with('orderProduct', 'orderProduct.prod')->get();
            $online_order = OnlineOrder::where('shop_id', $shop_id)->whereDate('created_at', $date)->where('status', 5)->with('onlineOrderProducts', 'onlineOrderProducts.prod')->get();

            $selling_price = 0;
            $buying_price  = 0;

            foreach ($order as $o) {

                foreach ($o->orderProduct as $op) {
                    $selling_price += $op->price;
                    $buying_price += $op->prod->buying_price;
                }

            }

            foreach ($online_order as $o) {

                foreach ($o->onlineOrderProducts as $op) {
                    $selling_price += $op->price;
                    $buying_price += $op->prod->buying_price;
                }

            }

            $data['profit'] = $selling_price - $buying_price;

            $data['total'] = ($data['sell'] + $data['other_sell']) - ($data['cost'] + $data['other_cost']);
        } elseif (request()->type == 2) {
            $year  = Carbon::parse(request()->selected_date)->format('Y');
            $month = Carbon::parse(request()->selected_date)->format('m');

            $data['sell'] = Order::where('shop_id', $shop_id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->sum('subtotal');
            $data['cost'] = Buy::where('shop_id', $shop_id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->sum('subtotal');

            $data['other_sell'] = OnlineOrder::where('shop_id', $shop_id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->where('status', 5)->sum('subtotal');
            $data['other_cost'] = ExpenseBookDetail::where('shop_id', $shop_id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->sum('amount');

            $order        = Order::where('shop_id', $shop_id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->with('orderProduct', 'orderProduct.prod')->get();
            $online_order = OnlineOrder::where('shop_id', $shop_id)->whereYear('created_at', $year)->whereMonth('created_at', $month)->where('status', 5)->with('onlineOrderProducts', 'onlineOrderProducts.prod')->get();

            $selling_price = 0;
            $buying_price  = 0;

            foreach ($order as $o) {

                foreach ($o->orderProduct as $op) {
                    $selling_price += $op->price;
                    $buying_price += $op->prod->buying_price;
                }

            }

            foreach ($online_order as $o) {

                foreach ($o->onlineOrderProducts as $op) {
                    $selling_price += $op->price;
                    $buying_price += $op->prod->buying_price;
                }

            }

            $data['profit'] = $selling_price - $buying_price;

            $data['total'] = ($data['sell'] + $data['other_sell']) - ($data['cost'] + $data['other_cost']);
        } elseif (request()->type == 3) {
            $date_from    = Carbon::parse(request()->date_from)->format('Y-m-d');
            $date_to      = Carbon::parse(request()->date_to)->format('Y-m-d');
            $data['sell'] = Order::where('shop_id', $shop_id)->whereBetween('created_at', [$date_from . " 00:00:00", $date_to . " 23:59:59"])->sum('subtotal');
            $data['cost'] = Buy::where('shop_id', $shop_id)->whereBetween('created_at', [$date_from . " 00:00:00", $date_to . " 23:59:59"])->sum('subtotal');

            $data['other_sell'] = OnlineOrder::where('shop_id', $shop_id)->whereBetween('created_at', [$date_from . " 00:00:00", $date_to . " 23:59:59"])->where('status', 5)->sum('subtotal');
            $data['other_cost'] = ExpenseBookDetail::where('shop_id', $shop_id)->whereBetween('created_at', [$date_from . " 00:00:00", $date_to . " 23:59:59"])->sum('amount');

            $order        = Order::where('shop_id', $shop_id)->whereBetween('created_at', [$date_from . " 00:00:00", $date_to . " 23:59:59"])->with('orderProduct', 'orderProduct.prod')->get();
            $online_order = OnlineOrder::where('shop_id', $shop_id)->whereBetween('created_at', [$date_from . " 00:00:00", $date_to . " 23:59:59"])->where('status', 5)->with('onlineOrderProducts', 'onlineOrderProducts.prod')->get();

            $selling_price = 0;
            $buying_price  = 0;

            foreach ($order as $o) {

                foreach ($o->orderProduct as $op) {
                    $selling_price += $op->price;
                    $buying_price += $op->prod->buying_price;
                }

            }

            foreach ($online_order as $o) {

                foreach ($o->onlineOrderProducts as $op) {
                    $selling_price += $op->price;
                    $buying_price += $op->prod->buying_price;
                }

            }

            $data['profit'] = $selling_price - $buying_price;

            $data['total'] = ($data['sell'] + $data['other_sell']) - ($data['cost'] + $data['other_cost']);
        } elseif (request()->type == 4) {
            $date = Carbon::parse(request()->selected_date)->format('Y-m-d');

            $data['sell'] = Order::where('shop_id', $shop_id)->whereYear('created_at', $date)->sum('subtotal');
            $data['cost'] = Buy::where('shop_id', $shop_id)->whereYear('created_at', $date)->sum('subtotal');

            $data['other_sell'] = OnlineOrder::where('shop_id', $shop_id)->whereYear('created_at', $date)->where('status', 5)->sum('subtotal');
            $data['other_cost'] = ExpenseBookDetail::where('shop_id', $shop_id)->whereYear('created_at', $date)->sum('amount');

            $order        = Order::where('shop_id', $shop_id)->whereYear('created_at', $date)->with('orderProduct', 'orderProduct.prod')->get();
            $online_order = OnlineOrder::where('shop_id', $shop_id)->whereYear('created_at', $date)->where('status', 5)->with('onlineOrderProducts', 'onlineOrderProducts.prod')->get();

            $selling_price = 0;
            $buying_price  = 0;

            foreach ($order as $o) {

                foreach ($o->orderProduct as $op) {
                    $selling_price += $op->price;
                    $buying_price += $op->prod->buying_price;
                }

            }

            foreach ($online_order as $o) {

                foreach ($o->onlineOrderProducts as $op) {
                    $selling_price += $op->price;
                    $buying_price += $op->prod->buying_price;
                }

            }

            $data['profit'] = $selling_price - $buying_price;

            $data['total'] = ($data['sell'] + $data['other_sell']) - ($data['cost'] + $data['other_cost']);
        } else {

            $data['sell'] = Order::where('shop_id', $shop_id)->whereMonth('created_at', date("Y-m-d"))->sum('subtotal');
            $data['cost'] = Buy::where('shop_id', $shop_id)->whereMonth('created_at', date("Y-m-d"))->sum('subtotal');

            $data['other_sell'] = OnlineOrder::where('shop_id', $shop_id)->whereMonth('created_at', date("Y-m-d"))->where('status', 5)->sum('subtotal');
            $data['other_cost'] = ExpenseBookDetail::where('shop_id', $shop_id)->whereMonth('created_at', date("Y-m-d"))->sum('amount');

            $order        = Order::where('shop_id', $shop_id)->whereMonth('created_at', date("Y-m-d"))->with('orderProduct', 'orderProduct.prod')->get();
            $online_order = OnlineOrder::where('shop_id', $shop_id)->whereMonth('created_at', date("Y-m-d"))->where('status', 5)->with('onlineOrderProducts', 'onlineOrderProducts.prod')->get();

            $selling_price = 0;
            $buying_price  = 0;

            foreach ($order as $o) {

                foreach ($o->orderProduct as $op) {
                    $selling_price += $op->price;
                    $buying_price += $op->prod->buying_price;
                }

            }

            foreach ($online_order as $o) {

                foreach ($o->onlineOrderProducts as $op) {
                    $selling_price += $op->price;
                    $buying_price += $op->prod->buying_price;
                }

            }

            $data['profit'] = $selling_price - $buying_price;

            $data['total'] = ($data['sell'] + $data['other_sell']) - ($data['cost'] + $data['other_cost']);
        }

        return $data;
    }

}
