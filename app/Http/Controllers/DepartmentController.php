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
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if(!auth()->user()->can('view_department')){
//            abort(403);
//        }
        return view('department.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

//        if(!auth()->user()->can('create_department')){
//            abort(403);
//        }
        return view('department.create');
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
           'title'=>'required|min:3',
        ]);








        $department = new Department();
        $department->title = $request->title;
        $department->save();

        return redirect()->route('department.index')->with('create','Department is successfully Created');


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

        if(!auth()->user()->can('edit_department')){
            abort(403);
        }

        $department = Department::findorFail($id);
        return view('department.edit',compact('department',));
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

        if(!auth()->user()->can('update_department')){
            abort(403);
        }

        $request->validate([
            'title'=>'required',
        ]);
        $department = Department::findorFail($id);
        $department->title = $request->title;
        $department->update();

        return redirect()->route('department.index')->with('update','Department is successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->can('delete_department')){
            abort(403);
        }

        $department = Department::findorFail($id);
        $department->delete();

        return 'success';
    }
    public function ssd(Request $request){
        if(!auth()->user()->can('view_department')){
            abort(403);
        }
        $departments = Department::query();
        return Datatables::of($departments)
            ->addColumn('action',function ($each){
                $edit_icon = '';
                $delete_icon = '';
                if(auth()->user()->can('edit_department')){
                    $edit_icon = '<a href="'.route('department.edit',$each->id).'">
                             <i class="fas fa-edit text-warning"></i>
                             </a>';
                }
                if(auth()->user()->can('delete_department')){
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
