@extends('layouts.main')
@section('title', 'PT BSGI | Edit Employee')
@section('content')
    <div class="panel panel-inverse" data-sortable-id="form-validation-1">
        <div class="panel-heading">
            <h4 class="panel-title">EDIT EMPLOYEE</h4>
        </div>

        <div class="panel-body">
            <a href="/employees" class="btn btn-sm btn-danger mb-3"><i class="fa fa-angles-left"></i> Back</a>
            <form class="form-horizontal" data-parsley-validate="true" action="/employees/{{ $employee->id }}" method="post">
                @method('put')
                @csrf
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="nik">NIK</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="nik" name="nik"
                            data-parsley-required="true" required value="{{ old('nik', $employee->nik) }}"
                            onkeypress="return isNumberKey(event)" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="nama">Nama</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="nama" name="nama"
                            data-parsley-required="true" required value="{{ old('nama', $employee->nama) }}" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="nama_depan">Nama Depan</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="nama_depan" name="nama_depan"
                            data-parsley-required="true" value="{{ old('nama_depan', $employee->nama_depan) }}" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="nama_belakang">Nama Belakang</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="nama_belakang"
                            name="nama_belakang" data-parsley-required="true"
                            value="{{ old('nama_belakang', $employee->nama_belakang) }}" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form form-check-label">Sex</label>
                    <div class="col-lg-8">
                        @if ($employee->sex === 'L')
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="sex1" name="sex" value="L"
                                    checked>
                                <label class="form-check-label" for="sex1">Laki Laki</label>
                            </div>
                        @else
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="sex2" name="sex" value="P"
                                    checked>
                                <label class="form-check-label" for="sex2">Perempuan</label>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="no_hp">No. Telp</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="no_hp" name="no_hp"
                            data-parsley-required="true" value="{{ old('no_hp', $employee->no_hp) }}"
                            onkeypress="return isNumberKey(event)" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="email">Email</label>
                    <div class="col-lg-8">
                        <input class="form-control" autocomplete="off" type="text" id="email" name="email"
                            data-parsley-required="true" value="{{ old('email', $employee->email) }}" />
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="col-lg-4 col-form-label form-label" for="alamat">Alamat</label>
                    <div class="col-lg-8">
                        <textarea name="alamat" id="alamat" class="form-control">{{ old('alamat', $employee->alamat) }}</textarea>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="form-label col-form-label col-lg-4" for="departement">Departement</label>
                    <div class="col-lg-8">
                        <select class="form-control departement" aria-label="Departement" name="id_dept">
                            <option></option>
                            @foreach ($departments as $dept)
                                @if (old('id_dept') === $dept->id || $employee->id_dept === $dept->id)
                                    <option value="{{ $dept->id }}" selected>{{ $dept->name }}</option>
                                @else
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endif
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
                                @if (old('id_dept') === $pos->id || $employee->id_position === $pos->id)
                                    <option value="{{ $pos->id }}" selected>{{ $pos->name }}</option>
                                @else
                                    <option value="{{ $pos->id }}">{{ $pos->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label class="form-label col-form-label col-lg-4" for="status">Status</label>
                    <div class="col-lg-8">
                        <select class="form-control" aria-label="Status" name="status">
                            @if ($employee->status === 'C')
                                <option value="C" selected>Kontrak</option>
                            @elseif($employee->status === 'P')
                                <option value="P" selected>Tetap</option>
                            @elseif($employee->status === 'O')
                                <option value="O">Outsourcing</option>
                            @else
                                <option></option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="hire_date" class="col-lg-4 col-form-label">Hire Date</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="hire_date" id="hire_date"
                            value="{{ old('hire_date', \Carbon\Carbon::parse($employee->hire_date)->format('m/d/Y')) }}"
                            autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="contract_exp_date" class="col-lg-4 col-form-label">Exp Contract Date</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="contract_exp_date" id="contract_exp_date"
                            value="{{ old('contract_exp_date', \Carbon\Carbon::parse($employee->contract_exp_date)->format('m/d/Y')) }}"
                            autocomplete="off" required>
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
@endsection
