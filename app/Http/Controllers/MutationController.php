<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MutationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = DB::table('shops')->get();
        $mutations = DB::table('mutations')
            ->join('shops as source', 'source.id', '=', 'mutations.source_id')
            ->join('shops as destination', 'destination.id', '=', 'mutations.destination_id')
            ->select(
                'mutations.id',
                'date',
                'destination.name as destination_name',
                'source.name as source_name',
                'total_item'
            )
            ->get();
        return view('mutation.mutation_data', ['shops' => $shops, 'mutations' => $mutations]);
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
        return 1;
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
        DB::table('mutation_details')->where('mutation_code', '=', $id)->delete();
        DB::table('mutations')->delete($id);

        return redirect('transaction/mutation')->with('status', 'Riwayat mutasi berhasil dihapus, namun stok barang tidak berubah');
    }

    public function genereteCode()
    {
        $today = Carbon::today();
        $year = $today->year()->format('Y');
        $month = $today->month()->format('m');
        $day = $today->day()->format('d');
        $first = 'MT';
        $id = DB::table('mutations')->select('id')->latest()->first();

        if ($id == null) {
            $code = $first . $year . $month . $day . 0;
        } else {
            $last = (int)$id->id + 1;
            $code = $first . $year . $month . $day . $last;
        }

        return $code;
    }

    public function createAlt($id)
    {
        $mutation_code = $this->genereteCode();
        $source = DB::table('shops')->where('id', '=', $id)->first();
        $shops = DB::table('shops')->get();
        $stocks = DB::table('stocks')
            ->where('shop_id', '=', $id)
            ->join('product_items', 'stocks.product_item_code', '=', 'product_items.code')
            ->get();
        $temps = DB::table('mutation_temps')
            ->join('product_items', 'mutation_temps.product_item_code', '=', 'product_items.code')
            ->get();
        return view('mutation.mutation_add_1', ['stocks' => $stocks, 'temps' => $temps, 'shops' => $shops, 'source' => $source, 'mutation_code' => $mutation_code]);
    }

    public function detailInsert(Request $request)
    {
        $source_id = $request->get('source_id');
        $mutation_code = $this->genereteCode();
        $product_item_code = $request->get('item_code');
        $qty = $request->get('qty');

        DB::table('mutation_temps')->insert([
            'mutation_code' => $mutation_code,
            'product_item_code' => $product_item_code,
            'qty' => $qty
        ]);

        return redirect('/transaction/mutation/createAlt/' . $source_id);
    }

    public function detailUpdate(Request $request, $id)
    {
        $source_id = $request->get('source_id');
        $qty = $request->get('qty');

        DB::table('mutation_temps')
            ->where('id', '=', $id)
            ->update([
                'qty' => $qty
            ]);

        return redirect('/transaction/mutation/createAlt/' . $source_id);
    }

    public function detailDelete(Request $request, $id)
    {
        $source_id = $request->get('source_id');
        DB::table('mutation_temps')->delete($id);
        return redirect('/transaction/mutation/createAlt/' . $source_id);
    }

    public function insert(Request $request)
    {
        $mutation_code = $this->genereteCode();
        $date = $request->get('mutationDate');
        $source_id = $request->get('sourceId');
        $destination_id = $request->get('destinationId');
        $total_item = $mutation_temps = DB::table('mutation_temps')->where('mutation_code', '=', $mutation_code)->count();
        $mutation_temps = DB::table('mutation_temps')->where('mutation_code', '=', $mutation_code)->get();

        DB::table('mutations')->insert([
            'code' => $mutation_code,
            'date' => $date,
            'source_id' => $source_id,
            'destination_id' => $destination_id,
            'total_item' => $total_item
        ]);

        foreach ($mutation_temps as $key) {
            DB::table('mutation_details')->insert([
                'mutation_code' => $key->mutation_code,
                'product_item_code' => $key->product_item_code,
                'qty' => $key->qty
            ]);

            $destinationStock = DB::table('stocks')
                ->where('shop_id', '=', $destination_id)
                ->where('product_item_code', '=', $key->product_item_code)
                ->count();


            if ($destinationStock == 0) {
                DB::table('stocks')->insert([
                    'shop_id' => $destination_id,
                    'product_item_code' => $key->product_item_code,
                    'stock' => $key->qty
                ]);

                $stockOldSource = DB::table('stocks')
                    ->where('shop_id', '=', $source_id)
                    ->where('product_item_code', '=', $key->product_item_code)
                    ->first()->stock;

                DB::table('stocks')
                    ->where('shop_id', '=', $source_id)
                    ->where('product_item_code', '=', $key->product_item_code)
                    ->update([
                        'stock' => $stockOldSource - $key->qty
                    ]);
            } else {
                $stockOldDestination = DB::table('stocks')
                    ->where('shop_id', '=', $destination_id)
                    ->where('product_item_code', '=', $key->product_item_code)
                    ->first()->stock;

                DB::table('stocks')
                    ->where('shop_id', '=', $destination_id)
                    ->where('product_item_code', '=', $key->product_item_code)
                    ->update([
                        'stock' => $stockOldDestination + $key->qty
                    ]);

                $stockOldSource = DB::table('stocks')
                    ->where('shop_id', '=', $source_id)
                    ->where('product_item_code', '=', $key->product_item_code)
                    ->first()->stock;

                DB::table('stocks')
                    ->where('shop_id', '=', $source_id)
                    ->where('product_item_code', '=', $key->product_item_code)
                    ->update([
                        'stock' => $stockOldSource - $key->qty
                    ]);
            }

            DB::table('mutation_temps')->delete($key->id);
        }


        return 1;
    }
}
