<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = DB::table('shops')->get();
        return view('shop.shop_data', ['shops' => $shops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shop.shop_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('shops')->insert([
            'name' => $request->get('name'),
            'telephone' => $request->get('telephone'),
            'address' => $request->get('address'),
            'description' => $request->get('description')
        ]);

        return redirect('/shop');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = DB::table('shops')->where('id', '=', $id)->get();
        $stocks = DB::table('stocks')
            ->where('shop_id', '=', $id)
            ->join('product_items', 'stocks.product_item_code', '=', 'product_items.code')
            ->select(
                'product_item_code',
                'product_items.name as name',
                'stock as stock'
            )
            ->get();
        return view('shop.shop_detail', ['shop' => $shop, 'stocks' => $stocks]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = DB::table('shops')->where('id', '=', $id)->get();
        return view('shop.shop_edit', ['shop' => $shop]);
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
        DB::table('shops')->where('id', '=', $id)->update([
            'name' => $request->get('name'),
            'telephone' => $request->get('telephone'),
            'address' => $request->get('address'),
            'description' => $request->get('description'),
        ]);

        return redirect('/shop/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('shops')->where('id', '=', $id)->delete();

        return redirect('/shop');
    }
}
