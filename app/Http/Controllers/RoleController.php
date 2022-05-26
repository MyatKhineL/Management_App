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
use Spatie\Permission\Models\Permission;
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
        if(!auth()->user()->can('view_role')){
            abort(403);
        }

        return view('role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->can('create_role')){
            abort(403);
        }

        $permissions = Permission::all();
        return view('role.create',compact('permissions'));
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
        $role->givePermissionTo($request->permissions);

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
        if(!auth()->user()->can('edit_role')){
            abort(403);
        }

        $role = Role::findorFail($id);
        $old_permissions = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::all();
        return view('role.edit',compact('role','permissions','old_permissions'));
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

        if(!auth()->user()->can('update_role')){
            abort(403);
        }

        $request->validate([
            'name'=>'required',
        ]);
        $role = Role::findorFail($id);
        $role->name = $request->name;
        $role->update();

        $old_permissions = $role->permissions->pluck('name')->toArray();

        $role->revokePermissionTo($old_permissions );

        $role->givePermissionTo($request->permissions);

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
        if(!auth()->user()->can('delete_role')){
            abort(403);
        }

        $role = Role::findorFail($id);
        $role->delete();

        return 'success';
    }
    public function ssd(Request $request){

        if(!auth()->user()->can('view_role')){
            abort(403);
        }

        $roles = Role::query();
        return Datatables::of($roles)
            ->addColumn('permissions',function ($each){
                $output = '';
                foreach($each->permissions as $p){
                    $output .= '<span class="badge bg-success text-white m-1">'.$p->name.'</span>';
                }
                return $output;
            })
            ->addColumn('action',function ($each){
                $edit_icon = '<a href="'.route('role.edit',$each->id).'">
                             <i class="fas fa-edit text-warning"></i>
                             </a>';
                $delete_icon = '<a href="#" class="text-danger delete-btn" data-id="'.$each->id.'">
                             <i class="fas fa-trash-alt"></i>
                             </a>';
                return '<div class="action-icon">'.$edit_icon.$delete_icon.'</div>';
            })
            ->rawColumns(['action','permissions'])
            ->make(true);
    }
}
