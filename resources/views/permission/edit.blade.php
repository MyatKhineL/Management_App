@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('permission.update',$permission->id)}}" method="post" id="createform">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label>Title</label>
                                        <input type="text" name="name" class="form-control" value="{{old('permission',$permission->name)}}">
                                        @error('name')
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

