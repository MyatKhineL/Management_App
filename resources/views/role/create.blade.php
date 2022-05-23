@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('role.store')}}" method="post" id="createform" enctype="multipart/form-data">
                            @csrf

                                <div class="col-md-4">

                                    <div class="form-group mt-3">
                                        <label>Title</label>
                                        <input type="text" name="name" class="form-control" value="{{old('title')}}">
                                        @error('title')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror

                                    </div>
                                </div>

                                    <p>Permission</p>
                                    <div class="row">
                                        @foreach($permissions as $p)
                                            <div class="col-md-3 col-6">
                                                <div class="form-group mt-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="permissions[]" type="checkbox" value="{{$p->name}}"  multiple id="checkbox_{{$p->id}}">
                                                        <label class="form-check-label pt-1" for="checkbox_{{$p->id}}">
                                                            {{$p->name}}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>



                                    <button type="submit" class="btn btn-primary">Confirm</button>




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

       </script>
@endsection

