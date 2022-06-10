<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanySettingRequest;
use App\Http\Requests\UpdateCompanySettingRequest;
use App\Models\CompanySetting;

class CompanySettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanySettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanySettingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanySetting  $companySetting
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!auth()->user()->can('view_company')){
            abort(403,'Unauthorized Action');
        }
         $companySetting = CompanySetting::findOrFail($id);
        return view('company.show',compact('companySetting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanySetting  $companySetting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->can('edit_company')){
            abort(403,'Unauthorized Action');
        }
        $companySetting = CompanySetting::findOrFail($id);
        return view('company.edit',compact('companySetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanySettingRequest  $request
     * @param  \App\Models\CompanySetting  $companySetting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanySettingRequest $request, $id)
    {
        if(!auth()->user()->can('edit_company')){
            abort(403,'Unauthorized Action');
        }
      $request->validate([
           'company_name' => 'required',
           'company_email' => 'required',
           'company_phone' => 'required',
           'company_address' => 'required',
           'office_start_time' =>'required',
           'office_end_time' =>'required',
           'break_start_time' =>'required',
           'break_end_time' =>'required',
      ]);
        $companySetting = CompanySetting::findorFail($id);
        $companySetting->company_name = $request->company_name;
        $companySetting->company_email =  $request->company_email;
        $companySetting->company_phone =$request->company_phone;
        $companySetting->company_address = $request->company_address;
        $companySetting->office_start_time = $request->office_start_time;
        $companySetting->office_end_time = $request->office_end_time;
        $companySetting->break_start_time = $request->break_start_time;
        $companySetting->break_end_time = $request->break_end_time;
        $companySetting->update();

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanySetting $companySetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanySetting $companySetting)
    {
        //
    }
}
