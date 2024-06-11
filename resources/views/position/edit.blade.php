@extends('layouts.main')
@section('title', 'CLOUD | Edit Position')
@section('content')
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">EDIT POSITION</h4>

        </div>

        <div class="panel-body">
            <a href="/position" class="btn btn-sm btn-danger mb-3"><i class="fa fa-angles-left"></i> Back</a>
            <form class="form-horizontal" data-parsley-validate="true" action="/position/{{ $position->id }}" method="post">
                @method('put')
                @csrf
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="name">Name</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="name" name="name"
                            data-parsley-required="true" required value="{{ old('name', $position->name) }}" />
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
