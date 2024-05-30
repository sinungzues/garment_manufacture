@extends('layouts.main')
@section('content')
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">Basic Form Validation</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                        class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i
                        class="fa fa-redo"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                        class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                        class="fa fa-times"></i></a>
            </div>
        </div>

        <div class="panel-body">
            <form class="form-horizontal" data-parsley-validate="true">
                @csrf
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="name">Full Name</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" id="name" name="name"
                            data-parsley-required="true" required />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="username">Username</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" id="username" name="username"
                            data-parsley-required="true" required />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="form-label col-form-label col-lg-4">Role</label>
                    <div class="col-lg-8">
                        <select class="role form-control">
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
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

        <div class="hljs-wrapper">
            <pre><code class="html" data-url="../assets/data/form-validation/code-1.json"></code></pre>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.role').select2();
        });
    </script>
@endsection
