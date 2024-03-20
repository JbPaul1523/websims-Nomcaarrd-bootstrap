<div class="modal fade" id="addEquipmentModal" tabindex="-1" aria-labelledby="addEquipmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEquipmentModalLabel">Add New Equipment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('equipment.store') }}">
                    @csrf
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
                                @foreach(\App\Models\Equipment::getConditionOptions() as $value => $label)
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
                            </select >
                        </div>
                        <div class="col-md-6">
                            <label>Assigned to Category:</label>
                            <select name="categories_id" class="form-control" required>
                                <option value="">Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select >
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
