@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('employee.store')}}" method="post" id="createform">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label>Employee ID</label>
                                        <input type="text" name="employee_id" class="form-control">
                                        @error('employee_id')
                                           <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control">
                                        @error('name')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Phone</label>
                                        <input type="number" name="phone" class="form-control">
                                        @error('phone')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control">
                                        @error('email')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>NRC Number</label>
                                        <input type="text" name="nrc_number" class="form-control">
                                        @error('nrc_number')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label>Birthday</label>
                                        <input type="text" name="birthday" class="form-control birthday">
                                        @error('birthday')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Department</label>
                                        <select name="department" class="form-control">
                                            @foreach($departments as $d)
                                                <option value="{{$d->id}}">{{$d->title}}</option>
                                            @endforeach
                                                @error('department')
                                                <span class="text-danger">*{{$message}}</span>
                                                @enderror
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Date of Join</label>
                                        <input type="text" name="date_of_join" class="form-control date_of_join">
                                        @error('date_of_join')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Is Present</label>
                                        <select name="is_present" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        @error('is_present')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                        @error('gender')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror

                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group mt-3">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" rows="5"></textarea>
                                        @error('address')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary btn-block">Confirm</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\StoreEmployee','#createform')!!}
       <script>
           $(document).ready(function (){
               $('.birthday').daterangepicker({
                   "singleDatePicker":true,
                   "autoApply":true,
                   "showDropdowns":true,
                   "maxDate":moment(),
                   "locale":{
                     "format":"YYY-MM-DD",
                   }
               });
               $('.date_of_join').daterangepicker({
                   "singleDatePicker":true,
                   "autoApply":true,
                   "showDropdowns":true,

                   "locale":{
                       "format":"YYY-MM-DD",
                   }
               });
           })
       </script>
@endsection

