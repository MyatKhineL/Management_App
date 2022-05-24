<?php

namespace App\Http\Controllers;


use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
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
        $roles = Role::all();
        $departments = Department::orderBy('title')->get();
        return view('employee.create',compact('departments','roles'));
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
           'employee_id'=>'required|unique:users,employee_id',
           'name'=>'required',
           'password'=>'required',
           'phone'=>'required|min:9|max:11|unique:users,phone',
           'email'=>'required|email|unique:users,email',
           'nrc_number'=>'required',
           'birthday'=>'required',
           'gender'=>'required',
           'address'=>'required',
           'department'=>'required',
           'date_of_join'=>'required',
           'is_present'=>'required',
           'profile_img'=>'file|mimes:jpeg,png'

       ]);








        $employee = new User();
        if($request->file('profile_img')){
            $image_name = uniqid().'.'.$request->file('profile_img')->extension();
            $request->file('profile_img')->storeAs("public/photo",$image_name);
        }

        $employee->employee_id=$request->employee_id;
        $employee->name=$request->name;
        $employee->password=Hash::make($request->password);
        $employee->phone=$request->phone;
        $employee->email=$request->email;
        $employee->nrc_number=$request->nrc_number;
        $employee->birthday=$request->birthday;
        $employee->department_id=$request->department;
        $employee->date_of_join=$request->date_of_join;
        $employee->is_present=$request->is_present;
        $employee->gender=$request->gender;
        $employee->address=$request->address;
        $employee->profile_img = $image_name;



        $employee->save();
        $employee->syncRoles($request->roles);


        return redirect()->route('employee.index')->with('create','Employee is successfully Created');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = User::findorFail($id);
        return view('employee.show',compact('employee'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::orderBy('title')->get();
        $employee = User::findorFail($id);
        $old_roles = $employee->roles->pluck('id')->toArray();
        $roles = Role::all();
        return view('employee.edit',compact('employee','departments','roles','old_roles'));
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

        $request->validate([
            'employee_id'=>'required|unique:users,employee_id,'.$id,
            'name'=>'required',
            'phone'=>'required|min:9|max:11|unique:users,phone,'.$id,
            'email'=>'required|email|unique:users,phone,'.$id,
            'nrc_number'=>'required',
            'birthday'=>'required',
            'gender'=>'required',
            'address'=>'required',
            'department'=>'required',
            'date_of_join'=>'required',
            'is_present'=>'required',

        ]);
        $employee = User::findorFail($id);



        $employee->employee_id=$request->employee_id;
        $employee->name=$request->name;
        $employee->password=$request->password ? Hash::make($request->password) : $employee->password;
        $employee->phone=$request->phone;
        $employee->email=$request->email;
        $employee->nrc_number=$request->nrc_number;
        $employee->birthday=$request->birthday;
        $employee->department_id=$request->department;
        $employee->date_of_join=$request->date_of_join;
        $employee->is_present=$request->is_present;
        $employee->gender=$request->gender;
        $employee->address=$request->address;
        if($request->file('profile_img')){
            $image_name = uniqid().'.'.$request->file('profile_img')->extension();
            $request->file('profile_img')->storeAs("public/photo",$image_name);
            $employee->profile_img = $image_name;
        }





        $employee->update();
        $employee->syncRoles($request->roles);
        return redirect()->route('employee.index')->with('update','Employee is successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = User::findorFail($id);
        $employee->delete();

        return 'success';
    }
    public function ssd(Request $request){
        $employees = User::with('department');
        return Datatables::of($employees)
            ->filterColumn('department_name',function ($query,$keyword){
                $query->whereHas('department',function ($q1) use ($keyword){
                    $q1->where('title','like','%'.$keyword.'%');
                });
            })
            ->editColumn('profile_img',function ($each){
                return   '<img src="'.$each->profile_img_path().'" class="thumbnail">';
            })
            ->addColumn('department_name',function ($each){
              return   $each->department ? $each->department->title : '-';
            })
            ->addColumn('role_name',function ($each){
                $output = '';
                foreach ($each->roles as $role){
                    $output .='<span class="badge bg-info text-white m-1 ">'.$role->name.'</span>';
                };
                return $output;
            })
            ->editColumn('is_present',function ($each){
                if($each->is_present == 1){
                    return '<span class="badge badge-pill badge-success ">Present</span>';
                }else {
                    return '<span class="badge badge-pill badge-danger ">Present</span>';

                }
            })
            ->editColumn('updated_at',function ($each){
                return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('plus-icon',function ($each){
                return null;
            })


            ->addColumn('action',function ($each){
                $edit_icon = '<a href="'.route('employee.edit',$each->id).'">
                             <i class="fas fa-edit text-warning"></i>
                             </a>';
                $info_icon = '<a href="'.route('employee.show',$each->id).'">
                             <i class="fas fa-info-circle text-info"></i>
                             </a>';
                $delete_icon = '<a href="#" class="text-danger delete-btn" data-id="'.$each->id.'">
                             <i class="fas fa-trash-alt"></i>
                             </a>';
                return '<div class="action-icon">'.$edit_icon.$info_icon.$delete_icon.'</div>';
            })
            ->rawColumns(['is_present','action','profile_img','role_name'])
            ->make(true);
    }



}
