<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = DB::table('product_items')
            ->join('product_categories', 'product_items.category_id', '=', 'product_categories.id')
            ->join('product_units', 'product_items.unit_id', '=', 'product_units.id')
            ->select(
                'code',
                'product_items.name as name',
                'product_categories.name as category',
                'product_units.name as unit',
                'purchase_price',
                'selling_price'
            )
            ->get();

        return view('product_items.item_data', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('product_categories')->get();
        $units = DB::table('product_units')->get();

        return view('product_items.item_add', ['categories' => $categories, 'units' => $units]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('product_items')->insert([
            'code' => $request->get('code'),
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'unit_id' => $request->get('unit_id'),
            'purchase_price' => $request->get('purchase_price'),
            'selling_price' => $request->get('selling_price')
        ]);

        return redirect('/product/item');
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
        $item = DB::table('product_items')
            ->join('product_categories', 'product_items.category_id', '=', 'product_categories.id')
            ->join('product_units', 'product_items.unit_id', '=', 'product_units.id')
            ->select(
                'code',
                'category_id',
                'unit_id',
                'product_items.name as name',
                'product_categories.name as category',
                'product_units.name as unit',
                'purchase_price',
                'selling_price'
            )
            ->where('product_items.code', '=', $id)
            ->get();

        $categories = DB::table('product_categories')->get();
        $unit = DB::table('product_units')->get();

        return view('product_items.item_edit', ['item' => $item, 'categories' => $categories, 'unit' => $unit]);
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
        DB::table('product_items')
        ->where('code', '=', $request->get('code'))
        ->update([
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'unit_id' => $request->get('unit_id'),
            'purchase_price' => $request->get('purchase_price'),
            'selling_price' => $request->get('selling_price')
        ]);

        return redirect('/product/item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('product_items')->where('code', '=' ,$id)->delete();

        return redirect('/product/item');
    }

    public function checkCode(Request $request)
    {
        $code = $request->input('code');
        $isExists = DB::table('product_items')->where('code', '=', $code)->first()->get();
        if ($isExists) {
            return response()->json(array("exists" => true));
        } else {
            return response()->json(array("exists" => false));
        }
    }
}
