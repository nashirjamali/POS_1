<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $generatecode = DB::table('employees')->select('id')->latest('id')->first();
        $id=$generatecode->id+1;
        return view('employee.employee_add',['id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->get('id');
        $name = $request->get('name');
        $level = $request->get('level');
        $username = $request->get('username');
        $password = Hash::make($request->get('password'));
        $address = $request->get('address');
        $telephone = $request->get('telephone');
        $jobtitle = $request->get('jabatan');

        DB::table('employees')->insert([
            'name' => $name,
            'job_title' => $jobtitle,
            'address' => $address,
            'telephone' => $telephone
        ]);

        DB::table('users')->insert([
            'employee_id' => $id,
            'name' => $name,
            'level' => $level,
            'username' => $username,
            'password' => $password
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

        $users = DB::table('users')->where('id', '=', $id)->get();

        return view('employee.employee_edit', ['employee' => $employee, 'users'=>$users]);
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
        $id = $request->get('id');
        $name = $request->get('name');
        $level = $request->get('level');
        $username = $request->get('username');
        $password = Hash::make($request->get('password'));
        $address = $request->get('address');
        $telephone = $request->get('telephone');
        $jobtitle = $request->get('jabatan');

        DB::table('employees')->where('id', '=', $id)->update([
            'name' => $name,
            'job_title' => $jobtitle,
            'address' => $address,
            'telephone' => $telephone
        ]);

        DB::table('users')->where('id', '=', $id)->update([
            'employee_id' => $id,
            'name' => $name,
            'level' => $level,
            'username' => $username,
            'password' => $password
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
        DB::table('users')->delete($id);
        return redirect('employee');
    }
}
