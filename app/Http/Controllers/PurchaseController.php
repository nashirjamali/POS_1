<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class PurchaseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = DB::table('purchases')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->join('shops', 'purchases.shop_id', '=', 'shops.id')
            ->select(
                'code',
                'date',
                'time',
                'suppliers.name as supplier',
                'shops.name as shop',
                'grand_total'
            )
            ->get();
        return view('purchase.purchase_data', ['purchases' => $purchases]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = DB::table('suppliers')->get();
        $shops = DB::table('shops')->get();
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
                'purchase_price'
            )
            ->get();


        $code = $this->genereteCode();
        $purchase_code = $code;

        $purchase_details = DB::table('purchase_temps')
            ->where('purchase_code', '=', $purchase_code)
            ->join('product_items', 'purchase_temps.product_item_code', '=', 'product_items.code')
            ->select(
                'id',
                'product_item_code',
                'qty',
                'sub_total',
                'product_items.name',
                'product_items.purchase_price'
            )
            ->get();

        return view('purchase.purchase_add', [
            'suppliers' => $suppliers,
            'shops' => $shops,
            'items' => $items,
            'code' => $code,
            'purchase_details' => $purchase_details
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase_details = DB::table('purchase_details')
            ->join('product_items', 'purchase_details.product_item_code', '=', 'product_items.code')
            ->where('purchase_code', '=', $id)
            ->select(
                'product_item_code',
                'qty',
                'sub_total',
                'product_items.name as name',
                'product_items.purchase_price as price'
            )
            ->get();
        $purchases = DB::table('purchases')
            ->where('code', '=', $id)
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->join('shops', 'purchases.shop_id', '=', 'shops.id')
            ->select(
                'code',
                'date',
                'time',
                'suppliers.name as supplier_name',
                'suppliers.address as supplier_address',
                'suppliers.telephone as supplier_telephone',
                'shops.name as shop_name',
                'shops.address as shop_address',
                'shops.telephone as shop_telephone',
                'grand_total',
                'note'
            )
            ->get();

        return view('purchase.purchase_detail', ['purchase_details' => $purchase_details, 'purchases' => $purchases]);
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

    public function genereteCode()
    {
        $today = Carbon::today();
        $year = $today->year()->format('Y');
        $month = $today->month()->format('m');
        $day = $today->day()->format('d');
        $first = 'PM';
        $id = DB::table('purchases')->select('id')->latest()->first();

        if ($id == null) {
            $code = $first . $year . $month . $day . 0;
        } else {
            $last = (int)$id->id + 1;
            $code = $first . $year . $month . $day . $last;
        }

        return $code;
    }


    public function insert(Request $request)
    {
        $purchase_code = $request->get('purchaseCode');
        $purchase_date = $request->get('purchaseDate');
        $purchase_time = $request->get('purchaseTime');
        $supplier_id = $request->get('supplierId');
        $shop_id = $request->get('shopId');
        $grand_total = $request->get('grandTotal');
        $note = $request->get('note');

        DB::table('purchases')->insert([
            'code' => $purchase_code,
            'date' => $purchase_date,
            'time' => $purchase_time,
            'supplier_id' => $supplier_id,
            'shop_id' => $shop_id,
            'grand_total' => $grand_total,
            'note' => $note
        ]);

        $temps = DB::table('purchase_temps')
            ->where('purchase_code', '=', $purchase_code)
            ->get();

        foreach ($temps as $temp) {
            DB::table('purchase_details')->insert([
                'purchase_code' => $temp->purchase_code,
                'product_item_code' => $temp->product_item_code,
                'qty' => $temp->qty,
                'sub_total' => $temp->sub_total
            ]);

            $isStock = DB::table('stocks')
                ->where('shop_id', '=', $shop_id)
                ->where('product_item_code', '=', $temp->product_item_code)
                ->first();

            if ($isStock == null) {

                DB::table('stocks')
                    ->insert([
                        'shop_id' => $shop_id,
                        'product_item_code' => $temp->product_item_code,
                        'stock' => $temp->qty
                    ]);
            } else {

                $stockOld = DB::table('stocks')
                    ->where('id', '=', $isStock->id)
                    ->first();

                DB::table('stocks')
                    ->where('id', '=', $isStock->id)
                    ->update([
                        'stock' => $stockOld->stock + $temp->qty
                    ]);
            }
        }

        DB::table('purchase_temps')
            ->where('purchase_code', '=', $purchase_code)
            ->delete();

        return redirect('/transaction/purchase');
    }


    public function detailInsert(Request $request)
    {
        $purchase_code = $request->get('purchase_code');

        $item_code = $request->get('item_code');
        $qty = $request->get('qty');
        $purchase_price = DB::table('product_items')->select('purchase_price')->where('code', '=', $item_code)->first()->purchase_price;
        $sub_total = $purchase_price * (int)$qty;

        DB::table('purchase_temps')->insert([
            'purchase_code' => $purchase_code,
            'product_item_code' => $item_code,
            'qty' => $qty,
            'sub_total' => $sub_total
        ]);

        return redirect('/transaction/purchase/create');
    }

    public function detailUpdate(Request $request, $id)
    {
        $qty = $request->get('qty');
        $purchase_price = $request->get('purchase_price');
        $sub_total = (int)$purchase_price * (int)$qty;

        DB::table('purchase_temps')
            ->where('id', '=', $id)
            ->update([
                'qty' => $qty,
                'sub_total' => $sub_total
            ]);

        return redirect('/transaction/purchase/create');
    }

    public function detailDelete($id)
    {
        DB::table('purchase_temps')
            ->delete($id);

        return redirect('/transaction/purchase/create');
    }
}
