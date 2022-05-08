@extends('layouts.app')

@section('title')
    Edit {{ $user->name }}
@endsection

@section('content')
    <section class="section">
        <x-bread-crumb title="Users">
            <div class="breadcrumb-item"><a href="{{ route('user.index') }}">User Lists</a></div>
            <div class="breadcrumb-item">Eidt User</div>
        </x-bread-crumb>

        <div class="row">
            <div class="col-12 col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Eidt User</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.update', $user->id) }}" id="editForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="card-body">
                                <form action="{{ route('user.store') }}" id="createForm" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-row mb-2">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ old('email', $user->email) }}" placeholder="user@gmail.com">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name', $user->name) }}" placeholder="Username">
                                        </div>
                                    </div>

                                    <div class="form-row mb-2">
                                        <div class="form-group col-md-6">
                                            <label>Role</label>
                                            <select class="form-control select2" name="role">
                                                <option value="">-- Please Choose --</option>
                                                <option value="admin" @if ($user->role == 'admin') selected @endif>
                                                    Admin</option>
                                                <option value="editor" @if ($user->role == 'editor') selected @endif>
                                                    Editor</option>
                                                <option value="user" @if ($user->role == 'user') selected @endif>User
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Status</label>
                                            <select class="form-control select2" name="status">
                                                <option value="">-- Please Choose --</option>
                                                <option value="1" @if ($user->status == '1') selected @endif>Ban
                                                </option>
                                                <option value="0" @if ($user->status == '0') selected @endif>UnBan
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Password">
                                    </div>

                                    <div class="form-group">
                                        <label>Profile Photo</label>
                                        <input type="file" class="form-control p-1" name="profile_photo"
                                            value="{{ old('profile_photo', $user->profile_photo) }}"
                                            accept="image/png, image/jpeg">
                                    </div>

                                    <div class="text-center">
                                        <a href="{{ route('user.index') }}" class="btn btn-danger mr-2">Cancel</a>
                                        <button class="btn btn-primary px-4">Confirm</button>
                                    </div>
                                </form>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateUserRequest', '#editForm') !!}
@endsection
