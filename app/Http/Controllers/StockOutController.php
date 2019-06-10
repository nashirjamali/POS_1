<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock_outs = DB::table('stock_outs')
            ->join('product_items', 'stock_outs.product_item_code', '=', 'product_items.code')
            ->get();

        return view('stock_out.out_data', ['stock_outs' => $stock_outs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = DB::table('shops')->get();
        $items = DB::table('product_items')->get();

        return view('stock_out.out_add', ['shops' => $shops, 'items' => $items]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = $request->get('date');
        $shop_id = $request->get('shop');
        $item_code = $request->get('item_code');
        $detail = $request->get('detail');
        $qty = $request->get('qty');

        DB::table('stock_outs')->insert([
            'date' => $date,
            'shop_id' => $shop_id,
            'product_item_code' => $item_code,
            'detail' => $detail,
            'qty' => $qty
        ]);

        $stock = DB::table('stocks')
            ->where('shop_id', '=', $shop_id)
            ->where('product_item_code', '=', $item_code)->first()->stock - $qty;

        DB::table('stocks')
            ->where('shop_id', '=', $shop_id)
            ->where('product_item_code', '=', $item_code)
            ->update([
                'stock' => $stock
            ]);

        return redirect('transaction/stock-out/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        DB::table('stock_outs')->delete($id);

        return redirect('transaction/stock-out/');
    }

    public function checkStock(Request $request)
    {
        $shopId = $request->get('shopId');
        $itemCode = $request->get('itemCode');
        $stock = DB::table('stocks')
            ->where('shop_id', '=', $shopId)
            ->where('product_item_code', '=', $itemCode)
            ->join('product_items', 'stocks.product_item_code', '=', 'product_items.code')
            ->get();

        return $stock;
    }
}
