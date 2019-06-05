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
        return view('selling.selling_data');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = DB::table('customers')->get();
        $cashier = DB::table('employees')->get();
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

        return view('selling.selling_add', ['customers' => $customers, 'cashier' => $cashier, 'items' => $items, 'code' => $code]);
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
}
