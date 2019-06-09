<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MutationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mutation.mutation_data');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = DB::table('shops')->get();

        return view('mutation.mutation_add_1', ['shops' => $shops]);
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
        //
    }

    public function genereteId()
    {
        $id = DB::table('mutations')->select('id')->latest()->first();

        if ($id == null) {
            return 1;
        } else {
            $id = (int)$id + 1;
            return $id;
        }
    }

    public function Create2(Request $request)
    {
        $source_id = $request->get('source_id');
        $stocks = DB::table('stocks')
            ->where('shop_id', '=', $source_id)
            ->join('product_items', 'stocks.product_item_code', '=', 'product_items.code')
            ->get();

        $temps = DB::table('mutation_temps')
            ->join('product_items', 'product_items.code', '=', 'mutation_temps.product_item_code')
            ->get();

        return view('mutation.mutation_add_2', ['stocks' => $stocks, 'temps' => $temps]);
    }

    public function detailInsert(Request $request)
    {
        $mutation_id = $this->genereteId();
        $product_item_code = $request->get('item_code');
        $qty = $request->get('qty');

        DB::table('mutation_temps')->insert([
            'mutation_id' => $mutation_id,
            'product_item_code' => $product_item_code,
            'qty' => $qty
        ]);

        return redirect('transaction/mutation/create2');
    }

    public function detailUpdate(Request $request)
    {
        $id = $request->get('id');
        $qty = $request->get('qty');

        DB::table('mutation_temps')
            ->where('id', '=', $id)
            ->update([
                'qty' => $qty
            ]);

        return redirect()->to('/transaction/mutation/create2');
    }
}
