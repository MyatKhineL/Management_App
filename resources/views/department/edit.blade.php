@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('department.update',$department->id)}}" method="post" id="createform">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" value="{{old('department',$department->title)}}">
                                        @error('title')
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

@endsection

