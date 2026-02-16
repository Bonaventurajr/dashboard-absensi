<div class="modal fade" id="checkOutModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('attendance.checkout') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Check Out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="employee_id_out" class="form-label">Select Employee</label>
                        <select name="employee_id" id="employee_id_out" class="form-control" required>
                            <option value="">Choose...</option>
                            @foreach(App\Models\Employee::where('status', 'active')->get() as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }} ({{ $employee->employee_id }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="photo_out" class="form-label">Photo (Optional)</label>
                        <input type="file" name="photo" id="photo_out" class="form-control" accept="image/*">
                        <small class="text-muted">Take a photo for verification</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Current Time</label>
                        <input type="text" class="form-control" value="{{ now()->format('H:i:s') }}" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Check Out</button>
                </div>
            </form>
        </div>
    </div>
</div>