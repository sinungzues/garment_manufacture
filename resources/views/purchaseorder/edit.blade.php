@extends('layouts.main')
@section('title', 'PT BSGI | Edit Purchase Order')
@section('content')
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">EDIT PURCHASE ORDER</h4>

        </div>

        <div class="panel-body">
            <a href="/purchaseorder" class="btn btn-sm btn-danger mb-3"><i class="fa fa-angles-left"></i> Back</a>
            <form class="form-horizontal" data-parsley-validate="true" action="/purchaseorder/{{ $purchaseOrder->id }}"
                method="post">
                @method('put')
                @csrf
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="nopo">No Po.</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="nopo" name="nopo"
                            data-parsley-required="true" required value="{{ old('nopo', $purchaseOrder->nopo) }}" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="date" class="col-lg-4 col-form-label">Date</label>
                    <div class="col-lg-8">
                        <input type="date" class="form-control" name="date" id="date"
                            value="{{ old('date', date('Y-m-d'), $purchaseOrder->date) }}" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label">Suplier</label>
                    <div class="col-lg-8">
                        <select class="form-select messar" aria-label="Default select example" name="id_suplier" required>
                            <option></option>
                            @foreach ($supliers as $sup)
                                @if (old('id_suplier') === $sup->id || $purchaseOrder->id_suplier === $sup->id)
                                    <option value="{{ $sup->id }}" selected>{{ $sup->name }}</option>
                                @else
                                    <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="attention" class="col-lg-4 col-form-label">Attention</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="attention" id="attention"
                            value="{{ old('attention', $purchaseOrder->attention) }}" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="remarks" class="col-lg-4 col-form-label">Remarks</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="remarks" id="remarks"
                            value="{{ old('remarks', $purchaseOrder->remarks) }}" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label">Currency</label>
                    <div class="col-lg-8">
                        <select class="form-select currencies" aria-label="Default select example" name="id_currency"
                            required>
                            <option></option>
                            @foreach ($currency as $cur)
                                @if ($purchaseOrder->id_currency === $cur->id)
                                    <option value="{{ $cur->id }}" selected>{{ $cur->name }}</option>
                                @else
                                    <option value="{{ $cur->id }}">{{ $cur->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <legend class="col-form-label col-lg-4 pt-0">PPN</legend>
                    <div class="col-lg-8">
                        <div class="form-check">
                            @if ($purchaseOrder->ppn === 'true')
                                <input class="form-check-input" type="checkbox" id="ppnCheck" name="ppn" value="true"
                                    onchange="updateCheckboxValue(this)" checked>
                            @else
                                <input class="form-check-input" type="checkbox" id="ppnCheck" name="ppn" value="false"
                                    onchange="updateCheckboxValue(this)">
                            @endif
                            <label class="form-check-label" for="ppnCheck">
                                Yes
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3 d-none" id="ppnTotal">
                    <label for="total_ppn" class="col-lg-4 col-form-label">Total PPN</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="total_ppn" id="total_ppn"
                            value="{{ old('total_ppn', $purchaseOrder->total_ppn) }}" readonly>
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

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            let lastNumber = "{{ $lastNumber ?? '' }}";

            if (lastNumber === '') {
                lastNumber = '000000';
            }

            let inputValue = document.getElementById('nopo').value.trim();
            let newNumber;
            if (inputValue === '' || isNaN(parseInt(inputValue))) {
                newNumber = parseInt(lastNumber) + 1;
            } else {
                newNumber = inputValue;
            }

            newNumber = newNumber.toString().padStart(6, '0');
            document.getElementById('nopo').value = newNumber;
        });


        var ppnCheckbox = document.getElementById('ppnCheck');
        var ppnTotal = document.getElementById('ppnTotal');
        var totalPpn = document.getElementById('total_ppn');

        ppnCheckbox.addEventListener('change', function() {
            if (this.checked) {
                ppnTotal.classList.remove('d-none');
                totalPpn.setAttribute('required', 'required');
            } else {
                ppnTotal.classList.add('d-none');
                totalPpn.removeAttribute('required');
            }
        });

        function updateCheckboxValue(checkbox) {
            if (checkbox.checked) {
                checkbox.value = "true";
                total_ppn.value = "{{ $ppn }}"
            } else {
                checkbox.value = "false";
                total_ppn.value = ""
            }
        }
    </script>
@endsection
