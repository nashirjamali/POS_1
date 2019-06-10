<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = DB::table('employees')->get();

        return view('employee.employee_data', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.employee_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get('name');
        $level = $request->get('level');
        $username = $request->get('username');
        $password = $request->get('password');
        $address = $request->get('address');
        $telephone = $request->get('telephone');

        DB::table('employees')->insert([
            'name' => $name,
            'level' => $level,
            'username' => $username,
            'password' => $password,
            'telephone' => $telephone,
            'address' => $address
        ]);

        return redirect('employee');
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
        $employee = DB::table('employees')->where('id', '=', $id)->get();

        return view('employee.employee_edit', ['employee' => $employee]);
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
        $name = $request->get('name');
        $level = $request->get('level');
        $username = $request->get('username');
        $password = $request->get('password');
        $address = $request->get('address');
        $telephone = $request->get('telephone');

        DB::table('employees')->where('id', '=', $id)->update([
            'name' => $name,
            'level' => $level,
            'username' => $username,
            'password' => $password,
            'telephone' => $telephone,
            'address' => $address
        ]);

        return redirect('employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('employees')->delete($id);
        return redirect('employee');
    }
}
