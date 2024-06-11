@extends('layouts.main')
@section('title', 'CLOUD | Add New Suplier')
@section('content')
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">ADD NEW SUPLIER</h4>

        </div>

        <div class="panel-body">
            <a href="/suplier" class="btn btn-sm btn-danger mb-3"><i class="fa fa-angles-left"></i> Back</a>
            <form class="form-horizontal" data-parsley-validate="true" action="/suplier" method="post">
                @csrf
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="name">Name</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="name" name="name"
                            data-parsley-required="true" required value="{{ old('name') }}" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="address">Address</label>
                    <div class="col-lg-8">
                        <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="tel">Tel</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="tel" name="tel"
                            data-parsley-required="true" value="{{ old('tel') }}" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="fax">Fax</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="fax" name="fax"
                            data-parsley-required="true" value="{{ old('fax') }}" />
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
