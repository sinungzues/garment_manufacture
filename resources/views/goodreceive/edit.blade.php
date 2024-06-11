@extends('layouts.main')
@section('title', 'CLOUD | Edit Good Receipt')
@section('content')
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">EDIT GOOD RECEIPT</h4>

        </div>

        <div class="panel-body">
            <a href="/goods-receipt" class="btn btn-sm btn-danger mb-3"><i class="fa fa-angles-left"></i> Back</a>
            <form class="form-horizontal" data-parsley-validate="true" action="/goods-receipt/{{ $goodReceive->id }}"
                method="post">
                @method('put')
                @csrf
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="no_gr">No. GR</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="no_gr" name="no_gr"
                            data-parsley-required="true" required value="{{ old('no_gr', $goodReceive->no_gr) }}" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="user_receive">User Receive</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="user_receive" name="user_receive"
                            data-parsley-required="true" required
                            value="{{ old('user_receive', $goodReceive->user_receive) }}" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="date" class="col-lg-4 col-form-label">Date</label>
                    <div class="col-lg-8">
                        <input type="date" class="form-control" name="date" id="date"
                            value="{{ old('date', date('Y-m-d'), $goodReceive->date) }}" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label" for="no_po">No. PO</label>
                    <div class="col-lg-8">
                        <select class="form-select nopo" aria-label="Default select example" name="no_po" required>
                            <option></option>
                            @foreach ($po as $p)
                                <option value="{{ $p->departement->name . $p->nopo }}"
                                    data-supplier-id="{{ $p->id_suplier }}"
                                    {{ old('no_po') == $p->departement->name . $p->nopo || $goodReceive->no_po == $p->departement->name . $p->nopo ? 'selected' : '' }}>
                                    {{ $p->departement->name . $p->nopo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label">Supplier</label>
                    <div class="col-lg-8">
                        <select class="form-select supplier" aria-label="Default select example" name="id_suplier" required>
                            <option></option>
                            @foreach ($supliers as $sup)
                                <option value="{{ $sup->id }}"
                                    {{ old('id_suplier') == $sup->id || $goodReceive->id_suplier ? 'selected' : '' }}>
                                    {{ $sup->name }}
                                </option>
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

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.nopo').change(function() {
                var selectedSupplierId = $(this).find(':selected').data('supplier-id');
                $('.supplier').val(selectedSupplierId).change();
            });
        });
    </script>
@endsection
