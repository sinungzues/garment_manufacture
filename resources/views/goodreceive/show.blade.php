@extends('layouts.main')
@section('title', 'CLOUD | Add Detail Good Receive')
@section('content')
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">Good Receive NO. {{ $gr->no_gr }}</h4>

        </div>

        <div class="panel-body">
            <a href="/goods-receipt" class="btn btn-sm btn-danger mb-3"><i class="fa fa-angles-left"></i> Back</a>
            <div class="row mt-3">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12 d-flex mb-3">
                            <label class="col-sm-4 col-form-label">No. PO</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $gr->no_po }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <label for="date" class="col-sm-4 col-form-label">Date</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($gr->date)->format('d/m/Y') }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <label class="col-sm-4 col-form-label">Suplier</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $gr->suplier->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <label class="col-sm-4 col-form-label">User Receive</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $gr->user_receive }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="panel panel-inverse">
        <div class="panel-heading panel-heading bg-blue-700 text-white">
            <h4 class="panel-title">DAFTAR ITEM GOOD RECEIVE NO. {{ $gr->no_gr }}</h4>

        </div>

        <div class="panel-body">
            <table width="100%" class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Material</th>
                        <th>Qty Order</th>
                        <th>Qty Receive Previous</th>
                        <th>Qty Remaining</th>
                        <th>Qty Receive Current</th>
                        <th>Satuan</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grd as $index => $grdet)
                        <form action="/goods-receiptdet/{{ $grdet->id }}/updateQty" method="POST">
                            @csrf
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $grdet->material }}</td>
                                <td class="text-center">{{ $grdet->qty }}</td>
                                <td class="text-center">{{ $grdet->qty_receive_previous }}</td>
                                @php
                                    $remain = $grdet->qty - $grdet->qty_receive_previous;
                                @endphp
                                <td class="text-center">{{ $remain }}</td>
                                <td class="text-center">
                                    <input type="number" min="0" max="{{ $remain }}" value="0"
                                        name="qty_receive_current" class="qty_receive_current"
                                        data-id="{{ $grdet->id }}"
                                        {{ $remain == 0 ? "readonly style='width: 50%; background-color:transparent;'" : '' }}>
                                </td>
                                @if ($grdet->id_satuan === null)
                                    <td></td>
                                @else
                                    <td class="text-center">{{ $grdet->satuan->name }}</td>
                                @endif
                                <td class="text-center">
                                    <button type="submit" class="btn btn-primary btn-sm save-btn"
                                        {{ $remain == 0 ? 'disabled' : '' }}><i class="fas fa-save"></i></button>
                                </td>
                            </tr>
                        </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
