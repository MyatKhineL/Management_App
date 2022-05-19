<?php

namespace App\Http\Controllers;


use App\Models\Department;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('role.create');
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
           'name'=>'required',
        ]);

        $role = new Role();
        $role->name = $request->name;
        $role->save();

        return redirect()->route('role.index')->with('create','Role is successfully Created');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $role = Role::findorFail($id);
        return view('role.edit',compact('role'));
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
            'name'=>'required',
        ]);
        $role = Role::findorFail($id);
        $role->name = $request->name;
        $role->update();

        return redirect()->route('role.index')->with('update','Role is successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findorFail($id);
        $role->delete();

        return 'success';
    }
    public function ssd(Request $request){
        $roles = Role::query();
        return Datatables::of($roles)
            ->addColumn('action',function ($each){
                $edit_icon = '<a href="'.route('role.edit',$each->id).'">
                             <i class="fas fa-edit text-warning"></i>
                             </a>';
                $delete_icon = '<a href="#" class="text-danger delete-btn" data-id="'.$each->id.'">
                             <i class="fas fa-trash-alt"></i>
                             </a>';
                return '<div class="action-icon">'.$edit_icon.$delete_icon.'</div>';
            })
            ->rawColumns(['action',])
            ->make(true);
    }
}
