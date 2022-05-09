<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployee;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::orderBy('title')->get();
        return view('employee.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
           'employee_id'=>'required',
           'name'=>'required',
           'phone'=>'required|min:9|max:11',
           'email'=>'required|email',
           'nrc_number'=>'required',
           'gender'=>'required',
           'birthday'=>'required',
           'address'=>'required',
           'department_id'=>'required',
           'date_of_join'=>'required',
           'is_present'=>'required'
       ]);
       return $request;
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
    public function ssd(Request $request){
        $employees = User::with('department');
        return Datatables::of($employees)
            ->addColumn('department_name',function ($each){
              return   $each->department ? $each->department->title : '-';
            })
            ->editColumn('is_present',function ($each){
                if($each->is_present == 1){
                    return '<span class="badge badge-pill badge-success ">Present</span>';
                }else {
                    return '<span class="badge badge-pill badge-danger ">Present</span>';

                }
            })
            ->rawColumns(['is_present'])
            ->make(true);
    }
}
