@extends('layouts.main')
@section('title', 'CLOUD | User')
@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">USER</h4>

        </div>

        <div class="panel-body">
            <a href="/user/create" class="btn btn-success mb-3">
                <i class="fa fa-user-plus me-1"></i> Add User
            </a>
            <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th width="1%" class="text-center">No</th>
                        <th class="text-nowrap text-center">Name</th>
                        <th class="text-nowrap text-center">Username</th>
                        <th class="text-nowrap text-center">Role</th>
                        <th class="text-nowrap text-center">Departement</th>
                        <th class="text-nowrap text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td width="1%" class="fw-bold text-center">{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>{{ $user->departement->name }}</td>
                            <td class="text-center">
                                <a href="/user/{{ $user->id }}/edit" class="btn btn-sm btn-yellow">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="/refresh/{{ $user->id }}" class="btn btn-info btn-sm"
                                    onclick="Refresh(event,'{{ $user->id }}')"><i class="fa fa-sync"></i></a>
                                <form action="/user/{{ $user->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" onclick="Delete(event)"><i
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
