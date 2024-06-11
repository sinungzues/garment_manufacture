@extends('layouts.main')
@section('title', 'CLOUD | Edit Purchase Order')
@section('content')
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">EDIT PURCHASE ORDER DETAIL</h4>

        </div>

        <div class="panel-body">
            <a href="/purchaseorder/{{ $purchaseOrderDetail->id }}" class="btn btn-sm btn-danger mb-3"><i
                    class="fa fa-angles-left"></i> Back</a>
            <form class="form-horizontal" data-parsley-validate="true"
                action="/purchaseorderdet/{{ $purchaseOrderDetail->id }}" method="post">
                @method('put')
                @csrf
                <div class="form-group row mb-3 row mb-3">
                    <label for="material" class="col-lg-4 col-form-label">Material</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="material" id="material"
                            value="{{ old('material', $purchaseOrderDetail->material) }}" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group row mb-3 row mb-3">
                    <label for="qty" class="col-lg-4 col-form-label">Qty</label>
                    <div class="col-lg-8">
                        <input type="number" class="form-control" name="qty" id="qty"
                            value="{{ old('qty', $purchaseOrderDetail->qty) }}" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group row mb-3 row mb-3">
                    <label class="col-lg-4 col-form-label" for="satuan">Satuan</label>
                    <div class="col-lg-8">
                        <select class="form-select satuan" aria-label="satuan" name="id_satuan" style="width:100%;">
                            <option></option>
                            @foreach ($satuan as $sat)
                                @if (old('id_satuan') === $sat->id || $purchaseOrderDetail->id_satuan === $sat->id)
                                    <option value="{{ $sat->id }}" selected>{{ $sat->name }}</option>
                                @else
                                    <option value="{{ $sat->id }}">{{ $sat->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3 row mb-3">
                    <label for="price" class="col-lg-4 col-form-label">Price</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="price" id="price"
                            value="{{ old('price', $purchaseOrderDetail->price) }}" required
                            onkeypress="return isNumberKey(event)" autocomplete="off">
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
        document.getElementById('price').addEventListener('input', function() {
            this.value = this.value.replace(/[,.]/g, '');
        });
    </script>
@endsection
