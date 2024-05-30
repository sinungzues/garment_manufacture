@extends('layouts.main')
@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Data Table - Default</h4>
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
            <a href="/role/create" class="btn btn-success mb-3">
                <i class="fa fa-user-plus me-1"></i> Add Role
            </a>
            <table id="data-table-default" width="100%"
                class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th width="1%" class="text-center">No</th>
                        <th class="text-nowrap text-center">Role Name</th>
                        <th class="text-nowrap text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $index => $role)
                        <tr>
                            <td width="1%" class="fw-bold text-center">{{ $index + 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="/role/{{ $role->id }}/edit" class="btn btn-sm btn-yellow">
                                <i class="fa fa-pencil"></i>
                                </a>
                                <form action="/role/{{ $role->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm"><i
                                            class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
