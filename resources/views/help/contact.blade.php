@extends('layouts.app')

@section('title', 'Contact Support')

@section('content')
<div class="container-fluid px-0">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <h4 class="mb-2">
                        <i class="fas fa-headset text-primary me-2"></i>
                        Contact Support
                    </h4>
                    <p class="text-muted mb-0">Get help from our support team</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card stat-card text-center h-100">
                <div class="card-body">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                        <i class="fas fa-envelope fa-3x text-primary"></i>
                    </div>
                    <h5>Email Support</h5>
                    <p class="text-muted">support@absensisystem.com</p>
                    <p class="small text-muted">Response time: 24 hours</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card text-center h-100">
                <div class="card-body">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                        <i class="fas fa-phone-alt fa-3x text-success"></i>
                    </div>
                    <h5>Phone Support</h5>
                    <p class="text-muted">+62 21 1234 5678</p>
                    <p class="small text-muted">Mon-Fri, 9AM-5PM</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card stat-card text-center h-100">
                <div class="card-body">
                    <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex p-4 mb-3">
                        <i class="fas fa-comment fa-3x text-info"></i>
                    </div>
                    <h5>Live Chat</h5>
                    <p class="text-muted">Available 24/7</p>
                    <button class="btn btn-info text-white">Start Chat</button>
                </div>
            </div>
        </div>
    </div>

    <div class="card stat-card mt-4">
        <div class="card-body">
            <h5 class="mb-4">Submit a Support Ticket</h5>
            <form action="{{ route('help.submit-ticket') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Message</label>
                        <textarea name="message" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Submit Ticket
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection