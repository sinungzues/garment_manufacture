@extends('layouts.main')
@section('title', 'PT BSGI | Add New User')
@section('content')
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">ADD NEW USER</h4>

        </div>

        <div class="panel-body">
            <a href="/user" class="btn btn-sm btn-danger mb-3"><i class="fa fa-angles-left"></i> Back</a>
            <form class="form-horizontal" data-parsley-validate="true" action="/user" method="post">
                @csrf
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="name">Full Name</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="name" name="name"
                            data-parsley-required="true" required />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="username">Username</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="username" name="username"
                            data-parsley-required="true" required />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="password">Password</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="password" id="password" name="password"
                            data-parsley-required="true" required />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="form-label col-form-label col-lg-4">Role</label>
                    <div class="col-lg-8">
                        <select class="role form-control" name="role_id">
                            <option></option>
                            @foreach ($roles as $role)
                                @if (old('role_id') === $role->id)
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                @else
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="form-label col-form-label col-lg-4" for="departement">Departement</label>
                    <div class="col-lg-8">
                        <select class="form-control departement" aria-label="Departement" name="id_dept">
                            <option></option>
                            @foreach ($departments as $dept)
                                @if (old('id_dept') === $dept->id)
                                    <option value="{{ $dept->id }}" selected>{{ $dept->name }}</option>
                                @else
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
