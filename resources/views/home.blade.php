@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-center">
                    <img src="{{$employee->profile_img_path()}}" class="profile-img">
                </div>
                <div class="col-md-6">

                </div>
            </div>
            <div class="row p-5">

                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="mb-1"><i class="fas fa-user"></i> Name</p>
                        <p class="text-muted mb-1">{{$employee->name}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="mb-1"><i class="fas fa-phone-alt"></i> Phone</p>
                        <p class="text-muted mb-1">{{$employee->phone}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="mb-1"><i class="fas fa-mail-bulk"></i>Email</p>
                        <p class="text-muted mb-1">{{$employee->email}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="mb-1"><i class="fas fa-dot-circle-o"></i>NRC Number</p>
                        <p class="text-muted mb-1">{{$employee->nrc_number}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="mb-1"><i class="fas fa-dot-circle-o"></i>Birthday</p>
                        <p class="text-muted mb-1">{{$employee->birthday}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="mb-1"><i class="fas fa-dot-circle-o"></i>Gender</p>
                        <p class="text-muted mb-1">{{$employee->gender}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="mb-1"><i class="fas fa-dot-circle-o"></i>Address</p>
                        <p class="text-muted mb-1">{{$employee->address}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="mb-1"><i class="fas fa-dot-circle-o"></i>Department</p>
                        <p class="text-muted mb-1">{{$employee->department? $employee->department->title : ''}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="mb-1"><i class="fas fa-dot-circle-o"></i>Date of join</p>
                        <p class="text-muted mb-1">{{$employee->date_of_join}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="mb-1"><i class="fas fa-dot-circle-o"></i>Is Present</p>
                        <p class="text-muted mb-1">{{$employee->is_present == 1 ? 'present' : 'No'}}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="mb-1"><i class="fas fa-road-lock"></i>Role</p>
                        @foreach($employee->roles as $r)
                            <p class="text-muted mb-1">{{$r->name}}</p>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>

    </div>
@endsection
