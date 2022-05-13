@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('employee.update',$employee->id)}}" method="post" id="createform" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label>Employee ID</label>
                                        <input type="text" name="employee_id" class="form-control" value="{{old('employee_id',$employee->employee_id)}}">
                                        @error('employee_id')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" value="{{old('name',$employee->name)}}">
                                        @error('name')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Password</label>
                                        <input type="text" name="password" class="form-control">
                                        @error('password')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Phone</label>
                                        <input type="number" name="phone" class="form-control" value="{{old('phone',$employee->phone)}}">
                                        @error('phone')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="{{old('email',$employee->email)}}">
                                        @error('email')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>NRC Number</label>
                                        <input type="text" name="nrc_number" class="form-control" value="{{old('nrc_number',$employee->nrc_number)}}">
                                        @error('nrc_number')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label>Birthday</label>
                                        <input type="text" name="birthday" class="form-control birthday" value="{{$employee->birthday}}">
                                        @error('birthday')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <label>Department</label>
                                        <select name="department" class="form-control" value="{{old('department',$employee->department)}}">
                                            @foreach($departments as $d)
                                                <option value="{{$d->id}}" @if($employee->department_id == $d->id) selected @endif>{{$d->title}}</option>
                                            @endforeach
                                            @error('department')
                                            <span class="text-danger">*{{$message}}</span>
                                            @enderror
                                        </select>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Date of Join</label>
                                        <input type="text" name="date_of_join" class="form-control date_of_join" value="{{$employee->date_of_join}}">
                                        @error('date_of_join')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Is Present</label>
                                        <select name="is_present" class="form-control" value="{{old('is_present',$employee->is_present)}}">
                                            <option value="1" @if($employee->is_present == 1) selected @endif>Yes</option>
                                            <option value="0" @if($employee->is_present == 0) selected @endif>No</option>
                                        </select>
                                        @error('is_present')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control" value="{{old('gender',$employee->gender)}}">
                                            <option value="male" @if($employee->gender == 'male') selected @endif>Male</option>
                                            <option value="female" @if($employee->gender == 'female') selected @endif>Female</option>
                                        </select>
                                        @error('gender')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Address</label>
                                        <textarea class="form-control" name="address" rows="">{{old('address',$employee->address)}}</textarea>
                                        @error('address')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group mt-3">
                                        <label>Profile Image</label>
                                        <input type="file" name="profile_img" class="form-control p-1" value="{{old('profile_img')}}" id="pf-image">
                                        <div class="preview_img">
                                          @if($employee->profile_img)
                                              <img src="{{$employee->profile_img_path()}}" width="100px" class="mt-2">
                                          @endif
                                        </div>
                                        @error('profile_img')
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
    {{--    {!! JsValidator::formRequest('App\Http\Requests\StoreEmployee','#createform')!!}--}}
    <script>
        $(document).ready(function (){
            $('.birthday').daterangepicker({
                "singleDatePicker":true,
                "autoApply":true,
                "showDropdowns":true,
                "maxDate":moment(),
                "locale":{
                    "format":"YYYY-MM-DD",
                }
            });
            $('.date_of_join').daterangepicker({
                "singleDatePicker":true,
                "autoApply":true,
                "showDropdowns":true,

                "locale":{
                    "format":"YYYY-MM-DD",
                }
            });
            $('#pf-image').on('change',function (){
                let file_length = document.getElementById('pf-image').files.length;
                $('.preview_img').html('');
                for(let i=0;i<file_length;i++){
                    $('.preview_img').append(`<img  src="${URL.createObjectURL(event.target.files[i])}" class="preview_img mt-2" />`);
                }

            })
        })
    </script>
@endsection

