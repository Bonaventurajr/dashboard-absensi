<!-- resources/views/partials/checkout-modal.blade.php -->
<div class="modal fade" id="checkOutModal" tabindex="-1" aria-labelledby="checkOutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="checkOutModalLabel">
                    <i class="fas fa-sign-out-alt me-2"></i>Check Out
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('attendance.checkout') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="employee_id_out" class="form-label">Select Employee <span class="text-danger">*</span></label>
                        <select name="employee_id" id="employee_id_out" class="form-control" required>
                            <option value="">-- Choose Employee --</option>
                            @foreach($activeEmployees ?? App\Models\Employee::where('status', 'active')->get() as $employee)
                                <option value="{{ $employee->id }}">
                                    {{ $employee->name }} ({{ $employee->employee_id }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="photo_out" class="form-label">Photo (Optional)</label>
                        <input type="file" class="form-control" id="photo_out" name="photo" accept="image/*">
                        <div class="form-text text-muted">
                            <small>Upload photo for verification (max 2MB). Allowed: jpg, jpeg, png</small>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Current Time</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                <input type="text" class="form-control" value="{{ now()->format('H:i:s') }}" readonly>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Current Date</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <input type="text" class="form-control" value="{{ now()->format('d F Y') }}" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-2">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Info:</strong> Make sure you have checked in today before checking out.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-sign-out-alt me-1"></i>Check Out
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>