@extends('layouts.main')
@section('title', 'PT BSGI | Purchase Order')
@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">PURCHASE ORDER</h4>

        </div>

        <div class="panel-body">
            <a href="/purchaseorder/create" class="btn btn-success mb-3">
                <i class="fa fa-cart-plus me-1"></i> Add PO
            </a>
            <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th class="text-center">No. PO</th>
                        <th data-type="date" data-format="DD/MM/YYYY" class="text-center text-nowrap">Date</th>
                        <th class="text-center text-nowrap">Messar</th>
                        <th class="text-center text-nowrap">Attention</th>
                        <th class="text-center text-nowrap">Remarks</th>
                        <th class="text-center text-nowrap">Vat</th>
                        <th class="text-center text-nowrap">User Input</th>
                        <th class="text-center text-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftar as $index => $d)
                        <tr>
                            @if (Auth::check())
                                @if (Auth::user()->role->name === 'Admin')
                                    <td class="text-center">
                                        @if ($d->status === 'NA')
                                            <span
                                                class="badge rounded-pill bg-danger">{{ $d->departement->name . $d->nopo }}</span>
                                        @elseif($d->status === 'P')
                                            <span
                                                class="badge rounded-pill bg-warning">{{ $d->departement->name . $d->nopo }}</span>
                                        @else
                                            <span
                                                class="badge rounded-pill bg-green">{{ $d->departement->name . $d->nopo }}</span>
                                        @endif
                                    </td>
                                @else
                                    <td class="text-center">
                                        @if ($d->status === 'NA')
                                            <span class="badge rounded-pill bg-danger">{{ $d->nopo }}</span>
                                        @elseif($d->status === 'P')
                                            <span class="badge rounded-pill bg-warning">{{ $d->nopo }}</span>
                                        @else
                                            <span class="badge rounded-pill bg-green">{{ $d->nopo }}</span>
                                        @endif
                                    </td>
                                @endif
                            @endif
                            <td>{{ \Carbon\Carbon::parse($d->date)->format('d/m/Y') }}</td>
                            <td>{{ $d->suplier->name }}</td>
                            <td class="text-center">{{ $d->attention }}</td>
                            <td>{{ $d->remarks }}</td>
                            @if ($d->ppn === 'false')
                                <td class="text-center">Tidak</td>
                            @else
                                <td class="text-center">Ya</td>
                            @endif
                            <td class="text-center">{{ $d->user->name }}</td>
                            <td class="text-center">
                                <a href="/purchaseorder/{{ $d->id }}" class="btn btn-sm btn-info"><i
                                        class="fa fa-eye"></i>
                                </a>
                                @if ($d->status === 'P')
                                    <a href="/purchaseorder/{{ $d->id }}/edit" class="btn btn-sm btn-yellow">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                @endif
                                <a href="/view-excel/{{ $d->id }}" class="btn btn-sm btn-green"><i
                                        class="fa fa-file-excel"></i></a>
                                @if ($d->status === 'P' && Auth::user()->role->name === 'Admin')
                                    <a onclick="Approve(event,{{ $d->id }})" class="btn btn-sm btn-primary"
                                        style="cursor:pointer;"><i class="fa fa-check-circle"></i>
                                    </a>
                                @endif
                                @if ($d->status === 'P')
                                    <form action="/purchaseorder/{{ $d->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger btn-sm" onclick="Delete(event)"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
