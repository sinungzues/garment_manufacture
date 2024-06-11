@extends('layouts.main')
@section('title', 'CLOUD | Add New Purchase Order')
@section('content')
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">PURCHASE ORDER NO. {{ $purchaseOrder->nopo }}</h4>

        </div>

        <div class="panel-body">
            <a href="/purchaseorder" class="btn btn-sm btn-danger mb-3"><i class="fa fa-angles-left"></i> Back</a>
            <div class="row mt-3">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12 d-flex mb-3">
                            <label for="date" class="col-sm-4 col-form-label">Date</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($purchaseOrder->date)->format('d/m/Y') }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <label class="col-sm-4 col-form-label">Suplier</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $purchaseOrder->suplier->name }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <label class="col-sm-4 col-form-label">Attention</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $purchaseOrder->attention }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <label class="col-sm-4 col-form-label">Currencies</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control"
                                    value="{{ $purchaseOrder->currency->code }} - {{ $purchaseOrder->currency->name }}"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-12 d-flex mb-3">
                            <label class="col-sm-4 col-form-label">Remarks</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" value="{{ $purchaseOrder->remarks }}" readonly>
                            </div>
                        </div>
                        <div class="col-12 d-flex mb-3">
                            <label class="col-sm-4 col-form-label">PPN</label>
                            <div class="col-sm-8">
                                @if ($purchaseOrder->ppn === 'true')
                                    <input type="text" class="form-control" value="Ya" readonly>
                                @else
                                    <input type="text" class="form-control" value="Tidak" readonly>
                                @endif
                            </div>
                        </div>
                        @if ($purchaseOrder->ppn === 'true')
                            <div class="col-12 d-flex mb-3">
                                <label class="col-sm-4 col-form-label">Total PPN (%)</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{ $purchaseOrder->total_ppn }}"
                                        readonly>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="panel panel-inverse">
        <div class="panel-heading panel-heading bg-blue-700 text-white">
            <h4 class="panel-title">DAFTAR ITEM PO NO. {{ $purchaseOrder->nopo }}</h4>

        </div>

        <div class="panel-body">
            @if ($purchaseOrder->status === 'P')
                <a href="/purchaseorderdet/create/{{ $purchaseOrder->id }}" class="btn btn-success btn-sm mb-3"><i
                        class="fa fa-plus"></i> Add Item</a>
            @endif
            <table width="100%" class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th class="text-center text-nowrap">No.</th>
                        <th class="text-center text-nowrap">Material</th>
                        <th class="text-center text-nowrap">Qty</th>
                        <th class="text-center text-nowrap">Satuan</th>
                        <th class="text-center text-nowrap">Price</th>
                        <th class="text-center text-nowrap">Amount</th>
                        @if ($purchaseOrder->status === 'P')
                            <th class="text-center text-nowrap">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($po_det as $index => $po)
                        @php
                            $qty = $po->qty;
                            $price = $po->price;
                            $amount = $qty * $price;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $po->material }}</td>
                            <td class="text-center">{{ $po->qty }}</td>
                            @if ($po->id_satuan === null)
                                <td></td>
                            @else
                                <td class="text-center">{{ $po->satuan->name }}</td>
                            @endif
                            <td>{{ number_format($po->price, 2, ',', '.') }}</td>
                            <td>{{ number_format($amount, 2, ',', '.') }}</td>
                            @if ($purchaseOrder->status === 'P')
                                <td class="text-center">
                                    <a href="/purchaseorderdet/{{ $po->id }}/edit" class="btn btn-warning btn-sm"><i
                                            class="fa fa-pencil"></i></a>
                                    <form action="/purchaseorderdet/{{ $po->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="id_po" value="{{ $po->id_po }}">
                                        <button class="btn btn-danger btn-sm" onclick="Delete(event)"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            @else
                            @endif
                        </tr>
                    @endforeach
                    @php
                        $po_detail = DB::table('purchase_order_details')
                            ->where('id_po', $purchaseOrder->id)
                            ->where('isdelete', 0)
                            ->get();
                    @endphp
                    @if ($po_detail->count() > 0)
                        @if ($purchaseOrder->ppn === 'true')
                            <tr>
                                <td colspan="4" style="border-top: solid 1px #000!important"></td>
                                <td style="border-top: solid 1px #000!important;text-align:right;">Sub Total
                                </td>
                                @php
                                    $totalAmount = 0;

                                    foreach ($po_det as $po) {
                                        $qty = $po->qty;
                                        $price = $po->price;
                                        $amount = $qty * $price;

                                        $totalAmount += $amount;
                                    }
                                @endphp
                                <td style="border-top: solid 1px #000!important">
                                    {{ number_format($totalAmount, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td style="text-align:right;">PPN</td>
                                @php
                                    $totalAmount = 0;

                                    foreach ($po_det as $po) {
                                        $qty = $po->qty;
                                        $price = $po->price;
                                        $amount = $qty * $price;
                                        $totalAmount += $amount;
                                    }
                                    $valuePPN = $purchaseOrder->total_ppn;
                                    $ppn = ($totalAmount * $valuePPN) / 100;
                                @endphp
                                <td>{{ number_format($ppn, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                                <td style="border-top: double 4px #000!important; font-weight:bold;text-align:right;">
                                    Grand Total</td>
                                @php
                                    $grandTotal = $ppn + $totalAmount;
                                @endphp
                                <td style="border-top: double 4px #000!important;font-weight:bold;">
                                    {{ number_format($grandTotal, 2, ',', '.') }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="4" style="border-top: solid 1px #000!important"></td>
                                <td style="border-top: solid 1px #000!important;font-weight:bold;text-align:right;">
                                    Grand Total</td>
                                @php
                                    $totalAmount = 0;

                                    foreach ($po_det as $po) {
                                        $qty = $po->qty;
                                        $price = $po->price;
                                        $amount = $qty * $price;
                                        $totalAmount += $amount;
                                    }
                                @endphp
                                <td style="border-top: solid 1px #000!important;font-weight:bold;">
                                    {{ number_format($totalAmount, 2, ',', '.') }}</td>
                            </tr>
                        @endif
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
