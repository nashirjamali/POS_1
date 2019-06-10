<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $income = DB::table('sellings')->sum('grand_total');
        $profit = DB::table('sellings')->sum('profit_total');
        $recentSelling = DB::table('sellings')->take(3)->get();

        return view('dashboard', ['income' => $income, 'profit' => $profit, 'recentSelling' => $recentSelling]);
    }
}
