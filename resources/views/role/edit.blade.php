@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('role.update',$role->id)}}" method="post" id="createform">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label>Title</label>
                                        <input type="text" name="name" class="form-control" value="{{old('role',$role->name)}}">
                                        @error('name')
                                        <span class="text-danger">*{{$message}}</span>
                                        @enderror
                                    </div>

                                </div>


                            </div>
                            <p>Permission</p>
                            <div class="row">
                                @foreach($permissions as $p)
                                    <div class="col-md-3 col-6">
                                        <div class="form-group mt-3">
                                            <div class="form-check">
                                                <input class="form-check-input" name="permissions[]" type="checkbox" value="{{$p->name}}" @if(in_array($p->id,$old_permissions)) checked @endif  multiple id="checkbox_{{$p->id}}">
                                                <label class="form-check-label pt-1" for="checkbox_{{$p->id}}">
                                                    {{$p->name}}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

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

