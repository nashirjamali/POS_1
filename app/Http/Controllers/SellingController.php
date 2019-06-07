<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellings = DB::table('sellings')->get();

        return view('selling.selling_data', ['sellings' => $sellings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = DB::table('customers')->get();
        $cashier = DB::table('employees')->where('id', '=', 1)->first();
        $items = DB::table('product_items')
            ->join('product_categories', 'product_items.category_id', '=', 'product_categories.id')
            ->join('product_units', 'product_items.unit_id', '=', 'product_units.id')
            ->select(
                'code',
                'category_id',
                'unit_id',
                'product_items.name as name',
                'product_categories.name as category',
                'product_units.name as unit',
                'selling_price'
            )
            ->get();

        $code = $this->genereteCode();
        $selling_code = $code;

        $selling_details = DB::table('selling_temps')
            ->where('selling_code', '=', $selling_code)
            ->join('product_items', 'selling_temps.product_item_code', '=', 'product_items.code')
            ->select(
                'id',
                'product_item_code',
                'qty',
                'sub_total',
                'total',
                'discount',
                'profit',
                'product_items.name as name',
                'product_items.selling_price as selling_price',
                'product_items.purchase_price as purchase_price'
            )
            ->get();

        return view('selling.selling_add', [
            'customers' => $customers,
            'cashier' => $cashier,
            'items' => $items,
            'code' => $code,
            'selling_details' => $selling_details
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sellings = DB::table('sellings')
            ->where('code', '=', $id)
            ->join('customers', 'sellings.customer_id', '=', 'customers.id')
            ->join('employees', 'sellings.cashier_id', '=', 'employees.id')
            ->select([
                'code',
                'date',
                'time',
                'grand_total',
                'note',
                'customers.name as customer_name',
                'customers.address as customer_address',
                'customers.telephone as customer_telephone',
                'employees.name as cashier_name'
            ])
            ->get();


        $selling_details = DB::table('selling_details')
            ->join('product_items', 'selling_details.product_item_code', '=', 'product_items.code')
            ->where('selling_code', '=', $id)
            ->get();

        return view('selling.selling_detail', ['sellings' => $sellings, 'selling_details' => $selling_details]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function insert(Request $request)
    {
        $selling_code = $request->get('sellingCode');
        $selling_date = $request->get('sellingDate');
        $selling_time = $request->get('sellingTime');
        $customer_id = $request->get('customerId');
        $cashier_id = $request->get('cashierId');
        $discount = $request->get('discount');
        $cash = $request->get('cash');
        $change = $request->get('change');
        $note = $request->get('note');
        $shop_id = 1;
        $sumTotal = 0;
        $purchase_price = 0;

        $sellingDetailTemps = DB::table('selling_temps')->where('selling_code', '=', $selling_code)->get();

        foreach ($sellingDetailTemps as $key) {
            $purchase_price += DB::table('product_items')->where('code', '=', $key->product_item_code)->first()->purchase_price * $key->qty;
            $sumTotal += $key->total;
        }

        $grand_total = $sumTotal - ($sumTotal * (int)$discount / 100);
        $profit_total = $grand_total - $purchase_price;

        DB::table('sellings')->insert([
            'code' => $selling_code,
            'date' => $selling_date,
            'time' => $selling_time,
            'shop_id' => $shop_id,
            'cashier_id' => $cashier_id,
            'customer_id' => $customer_id,
            'sub_total' => $sumTotal,
            'discount' => $discount,
            'grand_total' => $grand_total,
            'cash' => $cash,
            'change' => $change,
            'note' => $note,
            'profit_total' => $profit_total
        ]);

        foreach ($sellingDetailTemps as $key) {
            DB::table('selling_details')->insert([
                'selling_code' => $key->selling_code,
                'product_item_code' => $key->product_item_code,
                'qty' => $key->qty,
                'sub_total' => $key->sub_total,
                'discount' => $key->discount,
                'total' => $key->total,
                'profit' => $key->profit
            ]);

            $stock = DB::table('stocks')
                ->where('product_item_code', '=', $key->product_item_code)
                ->where('shop_id', '=', $shop_id)
                ->first()
                ->stock - $key->qty;

            DB::table('stocks')
                ->where('product_item_code', '=', $key->product_item_code)
                ->where('shop_id', '=', $shop_id)
                ->update([
                    'stock' => $stock
                ]);
        }

        DB::table('selling_temps')->where('selling_code', '=', $selling_code)->delete();

        return 1;
    }

    public function genereteCode()
    {
        $today = Carbon::today();
        $year = $today->year()->format('Y');
        $month = $today->month()->format('m');
        $day = $today->day()->format('d');
        $first = 'PJ';
        $id = DB::table('sellings')->select('id')->latest()->first();

        if ($id == null) {
            $code = $first . $year . $month . $day . 0;
        } else {
            $last = (int)$id->id + 1;
            $code = $first . $year . $month . $day . $last;
        }

        return $code;
    }

    public function detailInsert(Request $request)
    {
        $selling_code = $request->get('selling_code');
        $item_code = $request->get('item_code');
        $qty = $request->get('qty');
        $discount = $request->get('discount');
        $selling_price = DB::table('product_items')->where('code', '=', $item_code)->first()->selling_price;
        $purchase_price = DB::table('product_items')->where('code', '=', $item_code)->first()->purchase_price;
        $sub_total = $selling_price * (int)$qty;
        $total = $sub_total - ($sub_total * (int)$discount / 100);
        $profit = $total - ($purchase_price * $qty);

        DB::table('selling_temps')->insert([
            'selling_code' => $selling_code,
            'product_item_code' => $item_code,
            'qty' => $qty,
            'sub_total' => $sub_total,
            'discount' => $discount,
            'total' => $total,
            'profit' => $profit
        ]);

        return redirect('transaction/selling/create');
    }

    public function detailUpdate(Request $request, $id)
    {
        $qty = $request->get('qty');
        $discount = $request->get('discount');
        $selling_price = $request->get('selling_price');
        $purchase_price = $request->get('purchase_price');
        $sub_total = $selling_price * (int)$qty;
        $total = $sub_total - ($sub_total * (int)$discount / 100);
        $profit = ($selling_price * $qty) - ($purchase_price * $qty);

        DB::table('selling_temps')
            ->where('id', '=', $id)
            ->update([
                'qty' => $qty,
                'discount' => $discount,
                'sub_total' => $sub_total,
                'total' => $total,
                'profit' => $profit
            ]);

        return redirect('/transaction/selling/create');
    }

    public function detailDelete($id)
    {
        DB::table('selling_temps')
            ->delete($id);

        return redirect('transaction/selling/create');
    }
}
