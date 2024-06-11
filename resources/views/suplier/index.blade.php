@extends('layouts.main')
@section('title', 'CLOUD | Suplier')
@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">SUPLIER</h4>

        </div>

        <div class="panel-body">
            <a href="/suplier/create" class="btn btn-success mb-3">
                <i class="fa fa-plus me-1"></i> Add Suplier
            </a>
            <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th width="1%" class="text-center">No</th>
                        <th class="text-nowrap text-center">Name</th>
                        <th class="text-nowrap text-center">Address</th>
                        <th class="text-nowrap text-center">Telp</th>
                        <th class="text-nowrap text-center">Fax</th>
                        <th class="text-nowrap text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supliers as $index => $suplier)
                        <tr>
                            <td width="1%" class="fw-bold text-center">{{ $index + 1 }}</td>
                            <td>{{ $suplier->name }}</td>
                            <td>{{ $suplier->address }}</td>
                            <td>{{ $suplier->tel }}</td>
                            <td>{{ $suplier->fax }}</td>
                            <td class="text-center">
                                <a href="/suplier/{{ $suplier->id }}/edit" class="btn btn-sm btn-yellow">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <form action="/suplier/{{ $suplier->id }}" method="post" class="d-inline">
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
