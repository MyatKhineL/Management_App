@extends('layouts.app')
@section('content')
    <div class="card">
       <div class="card-body">

           <div class="row p-5">

               <div class="col-md-6">
                   <div class="mb-3">
                       <p class="mb-1"><i class="fas fa-user"></i> Name</p>
                       <p class="text-muted mb-1">{{$companySetting->company_name}}</p>
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="mb-3">
                       <p class="mb-1"><i class="fas fa-phone-alt"></i> Phone</p>
                       <p class="text-muted mb-1">{{$companySetting->company_phone}}</p>
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="mb-3">
                       <p class="mb-1"><i class="fas fa-mail-bulk"></i>Email</p>
                       <p class="text-muted mb-1">{{$companySetting->company_email}}</p>
                   </div>
               </div>



               <div class="col-md-6">
                   <div class="mb-3">
                       <p class="mb-1"><i class="fas fa-dot-circle-o"></i>Address</p>
                       <p class="text-muted mb-1">{{$companySetting->company_address}}</p>
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="mb-3">
                       <p class="mb-1"><i class="fas fa-dot-circle-o"></i>Start time</p>
                       <p class="text-muted mb-1">{{$companySetting->office_start_time}}</p>
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="mb-3">
                       <p class="mb-1"><i class="fas fa-dot-circle-o"></i>End time</p>
                       <p class="text-muted mb-1">{{$companySetting->office_end_time}}</p>
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="mb-3">
                       <p class="mb-1"><i class="fas fa-dot-circle-o"></i>Break Start time</p>
                       <p class="text-muted mb-1">{{$companySetting->break_start_time}}</p>
                   </div>
               </div>
               <div class="col-md-6">
                   <div class="mb-3">
                       <p class="mb-1"><i class="fas fa-dot-circle-o"></i>Break End time</p>
                       <p class="text-muted mb-1">{{$companySetting->break_end_time}}</p>
                   </div>
               </div>
               @can('edit_company')
               <div class="col-12">
                  <a href="{{route('company.edit',1)}}" class="btn btn-warning">Edit Company</a>
               </div>
               @endcan






           </div>
       </div>

    </div>
@endsection
@section('scripts')

@endsection

