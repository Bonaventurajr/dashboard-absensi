@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container-fluid px-0">
    <div class="row">
        <div class="col-md-4">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <div class="avatar-lg mx-auto mb-3" style="width: 120px; height: 120px;">
                        @if(auth()->user()->photo)
                            <img src="{{ asset(auth()->user()->photo) }}" 
                                 class="rounded-circle w-100 h-100" style="object-fit: cover;">
                        @else
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center w-100 h-100">
                                <span class="text-white" style="font-size: 3rem;">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <h4>{{ auth()->user()->name }}</h4>
                    <p class="text-muted">{{ auth()->user()->email }}</p>
                    <span class="badge bg-{{ auth()->user()->role == 'admin' ? 'primary' : (auth()->user()->role == 'manager' ? 'success' : 'info') }}">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card stat-card">
                <div class="card-header bg-white">
                    <h6 class="mb-0">Profile Information</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="200">Name</th>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ auth()->user()->phone ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>
                                <span class="badge bg-{{ auth()->user()->role == 'admin' ? 'primary' : (auth()->user()->role == 'manager' ? 'success' : 'info') }}">
                                    {{ ucfirst(auth()->user()->role) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Member Since</th>
                            <td>{{ auth()->user()->created_at->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Last Login</th>
                            <td>{{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('d F Y H:i') : 'Never' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection