@extends('layouts.main')
@section('title', 'CLOUD | Log')
@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">LOG</h4>
        </div>

        <div class="panel-body">
            <table id="data-table-default" width="100%" class="table table-striped table-bordered align-middle text-nowrap">
                <thead>
                    <tr>
                        <th width="1%" class="text-center">No</th>
                        <th class="text-nowrap text-center"></th>
                        <th class="text-nowrap text-center">Date</th>
                        <th class="text-nowrap text-center">User</th>
                        <th class="text-nowrap text-center">Message</th>
                        <th class="text-nowrap text-center">Context</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $index => $log)
                        <tr>
                            <td width="1%" class="fw-bold text-center">{{ $index + 1 }}</td>
                            @if ($log->level === 'info')
                                <td><span class="badge rounded-pill bg-info">{{ $log->level }}</span></td>
                            @elseif($log->level === 'error')
                                <td><span class="badge rounded-pill bg-danger">{{ $log->level }}</span></td>
                            @elseif($log->level === 'warning')
                                <td><span class="badge rounded-pill bg-warning">{{ $log->level }}</span></td>
                            @endif
                            <td>{{ $log->created_at }}</td>
                            <td>{{ $log->user->name }}</td>
                            <td>{{ $log->message }}</td>
                            <td>{{ $log->context }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
