<?php

namespace App\Http\Controllers;



use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->can('view_permission')){
           abort(403);
        }
        return view('permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('permission.create');
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

        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permission.index')->with('create','Permission is successfully Created');


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

        $permission = Permission::findorFail($id);
        return view('permission.edit',compact('permission'));
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
        $permission = Permission::findorFail($id);
        $permission->name = $request->name;
        $permission->update();

        return redirect()->route('permission.index')->with('update','Permission is successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findorFail($id);
        $permission->delete();

        return 'success';
    }
    public function ssd(Request $request){
        $permissions = Permission::query();
        return Datatables::of($permissions)
            ->addColumn('action',function ($each){
                $edit_icon='';
                $delete_icon='';
                if(auth()->user()->can('edit_permission')){
                    $edit_icon = '<a href="'.route('permission.edit',$each->id).'">
                             <i class="fas fa-edit text-warning"></i>
                             </a>';
                }
                if(auth()->user()->can('delete_permission')){
                    $delete_icon = '<a href="#" class="text-danger delete-btn" data-id="'.$each->id.'">
                             <i class="fas fa-trash-alt"></i>
                             </a>';
                }



                return '<div class="action-icon">'.$edit_icon.$delete_icon.'</div>';
            })
            ->rawColumns(['action',])
            ->make(true);
    }
}
