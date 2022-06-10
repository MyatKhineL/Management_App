@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('company.update',$companySetting->id)}}" method="post" id="createform" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label>Company Name</label>
                                        <input type="text" name="company_name" class="form-control" value="{{old('company_name',$companySetting->company_name)}}">
                                        @error('employee_id')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Company Phone</label>
                                        <input type="text" name="company_phone" class="form-control" value="{{old('company_phone',$companySetting->company_phone)}}">
                                        @error('employee_id')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Company Email</label>
                                        <input type="text" name="company_email" class="form-control" value="{{old('company_email',$companySetting->company_email)}}">
                                        @error('employee_id')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Company Address</label>
                                        <textarea name="company_address" class="form-control">{{$companySetting->company_address}}</textarea>
                                        @error('employee_id')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>




                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label>Office Start time</label>
                                        <input type="text" name="office_start_time" class="form-control timepacker" value="{{old('office_start_time',$companySetting->office_start_time)}}">
                                        @error('office_start_time')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Office End time</label>
                                        <input type="text" name="office_end_time" class="form-control timepacker" value="{{old('office_end_time',$companySetting->office_end_time)}}">
                                        @error('office_end_time')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Break Start time</label>
                                        <input type="text" name="break_start_time" class="form-control timepacker" value="{{old('break_start_time',$companySetting->break_start_time)}}">
                                        @error('break_start_time')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label>Break End time</label>
                                        <input type="text" name="break_end_time" class="form-control timepacker" value="{{old('break_end_time',$companySetting->break_end_time)}}">
                                        @error('break_end_time')
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
            $(".timepacker").daterangepicker({
                "singleDatePicker": true,
                "timePicker": true,
                "timePicker24Hour": true,
                "timePickerSeconds": true,
                "autoApply": true,
                "locale": {
                    "format": "HH:mm:ss",
                }
            }).on('show.daterangepicker', function(ev, picker) {
                picker.container.find('.calendar-table').hide();
            });


        })
    </script>
@endsection

