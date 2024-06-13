@extends('layouts.main')
@section('title', 'CLOUD | Employee')
@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">EMPLOYEE</h4>

        </div>

        <div class="panel-body">
            <a href="/employees/create" class="btn btn-success mb-3">
                <i class="fa fa-plus me-1"></i> Add Employee
            </a>
            <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th width="1%" class="text-center">No</th>
                        <th class="text-center">NIK</th>
                        <th class="text-nowrap text-center">Nama</th>
                        <th class="text-nowrap text-center">Sex</th>
                        <th class="text-nowrap text-center">Position</th>
                        <th class="text-nowrap text-center">Dept</th>
                        <th class="text-nowrap text-center">Status</th>
                        <th class="text-nowrap text-center">Join Date</th>
                        <th class="text-nowrap text-center">Exp Contract</th>
                        <th class="text-nowrap text-center">No. Telp</th>
                        <th class="text-nowrap text-center">Email</th>
                        <th class="text-nowrap text-center">Alamat</th>
                        <th class="text-nowrap text-center">Aktif</th>
                        <th class="text-nowrap text-center">QR</th>
                        <th class="text-nowrap text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $index => $employee)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $employee->nik }}</td>
                            <td>{{ $employee->nama }}</td>
                            <td class="text-center">{{ $employee->sex }}</td>
                            <td class="text-center">{{ $employee->position->name }}</td>
                            <td class="text-center">{{ $employee->departement->name }}</td>
                            <td class="text-center">{{ $employee->status }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($employee->hire_date)->format('d M Y') }}</td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($employee->contract_exp_date)->format('d M Y') }}</td>
                            <td>{{ $employee->no_hp }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->alamat }}</td>
                            <td class="text-center">
                                @if ($employee->is_active === 1)
                                    Ya
                                @else
                                    Tidak
                                @endif
                            </td>
                            <td>
                                <img src="{{ route('qr-code', $employee->nik . '.png') }}" alt="QR Code {{ $employee->nama . ' ' . $employee->nik }}" width="50">
                            </td>
                            <td class="text-center">
                                <a href="/employees/{{ $employee->id }}/edit" class="btn btn-sm btn-yellow">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                @if ($employee->is_active === 1)
                                    <a href="/employees/not-active/{{ $employee->id }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-times"></i>
                                    </a>
                                @else
                                    <a href="/employees/active/{{ $employee->id }}" class="btn btn-sm btn-green">
                                        <i class="fa fa-check"></i>
                                    </a>
                                @endif
                                <form action="/employees/{{ $employee->id }}" method="post" class="d-inline">
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
