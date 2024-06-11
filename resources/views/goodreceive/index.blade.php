@extends('layouts.main')
@section('title', 'CLOUD | Good Receipt')
@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">GOOD RECEIPT</h4>
        </div>

        <div class="panel-body">
            <a href="/goods-receipt/create" class="btn btn-success mb-3">
                <i class="fa fa-cart-plus me-1"></i> Add Good Receipt
            </a>
            <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th class="text-center">No. GR</th>
                        <th class="text-center text-nowrap">User Receive</th>
                        <th data-type="date" data-format="DD/MM/YYYY" class="text-center text-nowrap">Date</th>
                        <th class="text-center text-nowrap">No. PO</th>
                        <th class="text-center text-nowrap">Suplier</th>
                        <th class="text-center text-nowrap">User Input</th>
                        <th class="text-center text-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($receive as $index => $rec)
                        <tr>
                            <td>{{ $rec->no_gr }}</td>
                            <td>{{ $rec->user_receive }}</td>
                            <td>{{ \Carbon\Carbon::parse($rec->date)->format('d/m/Y') }}</td>
                            <td>{{ $rec->no_po }}</td>
                            <td>{{ $rec->suplier->name }}</td>
                            <td>{{ $rec->user->name }}</td>
                            <td class="text-center">
                                <a href="/goods-receipt/{{ $rec->id }}" class="btn btn-sm btn-info"><i
                                        class="fa fa-eye"></i>
                                </a>
                                <a href="/goods-receipt/{{ $rec->id }}/edit" class="btn btn-sm btn-yellow">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <form action="/goods-receipt/{{ $rec->id }}" method="post" class="d-inline">
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
