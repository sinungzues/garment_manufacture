@extends('layouts.main')
@section('title', 'CLOUD | Position')
@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">POSITION</h4>

        </div>

        <div class="panel-body">
            <a href="/position/create" class="btn btn-success mb-3">
                <i class="fa fa-plus me-1"></i> Add Position
            </a>
            <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th width="1%" class="text-center">No</th>
                        <th class="text-nowrap text-center">Position</th>
                        <th class="text-nowrap text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($positions as $index => $position)
                        <tr>
                            <td width="1%" class="fw-bold text-center">{{ $index + 1 }}</td>
                            <td>{{ $position->name }}</td>
                            <td class="text-center">
                                <a href="/position/{{ $position->id }}/edit" class="btn btn-sm btn-yellow">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <form action="/position/{{ $position->id }}" method="post" class="d-inline">
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
