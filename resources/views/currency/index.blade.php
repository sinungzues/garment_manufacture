@extends('layouts.main')
@section('title', 'CLOUD | Currency')
@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">CURRENCY</h4>

        </div>

        <div class="panel-body">
            <a href="/currency/create" class="btn btn-success mb-3">
                <i class="fa fa-plus me-1"></i> Add Currency
            </a>
            <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th width="1%" class="text-center">No</th>
                        <th class="text-nowrap text-center">Currency</th>
                        <th class="text-nowrap text-center">Code</th>
                        <th class="text-nowrap text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($currency as $index => $curr)
                        <tr>
                            <td width="1%" class="fw-bold text-center">{{ $index + 1 }}</td>
                            <td>{{ $curr->name }}</td>
                            <td>{{ $curr->code }}</td>
                            <td class="text-center">
                                <a href="/currency/{{ $curr->id }}/edit" class="btn btn-sm btn-yellow">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <form action="/currency/{{ $curr->id }}" method="post" class="d-inline">
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
