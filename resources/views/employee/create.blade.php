@extends('layouts.main')
@section('title', 'PT BSGI | Add New Employee')
@section('content')
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">ADD NEW EMPLOYEE</h4>
        </div>

        <div class="panel-body">
            <a href="/employees" class="btn btn-sm btn-danger mb-3"><i class="fa fa-angles-left"></i> Back</a>
            <form class="form-horizontal" data-parsley-validate="true" action="/employees" method="post">
                @csrf
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="nik">NIK</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="nik" name="nik"
                            data-parsley-required="true" required value="{{ old('nik') }}"
                            onkeypress="return isNumberKey(event)" readonly />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="nama">Nama</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="nama" name="nama"
                            data-parsley-required="true" required value="{{ old('nama') }}" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="nama_depan">Nama Depan</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="nama_depan" name="nama_depan"
                            data-parsley-required="true" value="{{ old('nama_depan') }}" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="nama_belakang">Nama Belakang</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="nama_belakang"
                            name="nama_belakang" data-parsley-required="true" value="{{ old('nama_belakang') }}" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form form-check-label">Sex</label>
                    <div class="col-lg-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="sex1" name="sex" value="L"
                                checked>
                            <label class="form-check-label" for="sex1">Laki Laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="sex2" name="sex" value="P">
                            <label class="form-check-label" for="sex2">Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="no_hp">No. Telp</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="no_hp" name="no_hp"
                            data-parsley-required="true" value="{{ old('no_hp') }}"
                            onkeypress="return isNumberKey(event)" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="email">Email</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="email" name="email"
                            data-parsley-required="true" value="{{ old('email') }}" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="alamat">Alamat</label>
                    <div class="col-lg-8">
                        <textarea name="alamat" id="alamat" class="form-control">{{ old('alamat') }}</textarea>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="form-label col-form-label col-lg-4" for="departement">Departement</label>
                    <div class="col-lg-8">
                        <select class="form-control departement" aria-label="Departement" name="id_dept">
                            <option></option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('id_dept') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="form-label col-form-label col-lg-4" for="position">Position</label>
                    <div class="col-lg-8">
                        <select class="form-control position" aria-label="Position" name="id_position">
                            <option></option>
                            @foreach ($positions as $pos)
                                <option value="{{ $pos->id }}"
                                    {{ old('id_position') == $pos->id ? 'selected' : '' }}>{{ $pos->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="form-label col-form-label col-lg-4" for="status">Status</label>
                    <div class="col-lg-8">
                        <select class="form-control" aria-label="Status" name="status">
                            <option></option>
                            <option value="C" {{ old('status') == 'C' ? 'selected' : '' }}>Kontrak</option>
                            <option value="P" {{ old('status') == 'P' ? 'selected' : '' }}>Tetap</option>
                            <option value="O" {{ old('status') == 'O' ? 'selected' : '' }}>Outsourcing</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="hire_date" class="col-lg-4 col-form-label">Hire Date</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="hire_date" id="hire_date"
                            value="{{ old('hire_date') }}" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="contract_exp_date" class="col-lg-4 col-form-label">Exp Contract Date</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="contract_exp_date" id="contract_exp_date"
                            value="{{ old('contract_exp_date') }}" required autocomplete="off">
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
                lastNumber = '0';
            }

            let inputValue = document.getElementById('nik').value.trim();
            let newNumber;
            if (inputValue === '' || isNaN(parseInt(inputValue))) {
                newNumber = parseInt(lastNumber) + 1;
            } else {
                newNumber = inputValue;
            }

            newNumber = newNumber.toString().padStart(1, '0');
            document.getElementById('nik').value = newNumber;
        });
    </script>
@endsection
