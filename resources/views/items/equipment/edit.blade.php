<div class="modal fade" id="edit{{ $equipment->id }}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Equipment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('equipment.update', $equipment->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label>Description:</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>
                        <div class="col-md-6">
                            <label>Serial Number:</label>
                            <input type="text" class="form-control" name="serial_number" required>
                        </div>
                        <div class="col-md-6">
                            <label>Amount</label>
                            <input type="text" class="form-control" name="amount" required>
                        </div>
                        <div class="col-md-6">
                            <label>Date Acquired:</label>
                            <input type="date" class="form-control" name="date_acquired" required>
                        </div>
                        <div class="col-md-6">
                            <label>Condition:</label>
                            <select class="form-control" name="condition" required>
                                @foreach (\App\Models\Equipment::getConditionOptions() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Assigned to:</label>
                            <select name="employees_id" class="form-control" required>
                                <option value="">Select an Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fa fa-times"></i>
                            Cancel</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i>
                            Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
