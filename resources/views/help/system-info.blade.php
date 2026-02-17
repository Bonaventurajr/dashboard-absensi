@extends('layouts.app')

@section('title', 'System Information')

@section('content')
<div class="container-fluid px-0">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('help.index') }}" class="btn btn-outline-secondary me-3">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div>
                            <h4 class="mb-2">
                                <i class="fas fa-info-circle text-secondary me-2"></i>
                                System Information
                            </h4>
                            <p class="text-muted mb-0">Technical details about your installation</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card stat-card">
        <div class="card-body">
            <table class="table">
                @foreach($info as $key => $value)
                <tr>
                    <th width="200">{{ ucfirst(str_replace('_', ' ', $key)) }}</th>
                    <td>{{ $value }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection