@extends('layouts.main')
@section('title', 'CLOUD | PPN')
@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">PPN</h4>

        </div>

        <div class="panel-body">
            <form method="post" action="/ppn" class="pt-3">
                @csrf
                <div class="row mb-3">
                    <label for="ppn" class="col-sm-2 col-form-label">Total PPN</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ppn" id="ppn" autocomplete="off"
                            value="{{ $ppn }}" required onkeypress="return isNumberKey(event)">
                    </div>
                </div>
                <div class="row mb-3 d-none">
                    <label for="old_ppn" class="col-sm-2 col-form-label">Total PPN</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" name="old_ppn" id="old_ppn" autocomplete="off"
                            value="{{ $ppn }}" required onkeypress="return isNumberKey(event)">
                    </div>
                </div>
                <div class="row mb-3 mt-5 ms-auto">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('ppn').addEventListener('input', function() {
            this.value = this.value.replace(/[,]/g, '.');
        });
    </script>
@endsection
