<!-- Select Employee Modal -->
<div class="modal fade" id="selectEmployeeModal" tabindex="-1" aria-labelledby="selectEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectEmployeeModalLabel">Select Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="selectEmployeeForm">
                    <div class="mb-3">
                        <label for="employeeSelect" class="form-label">Select Employee:</label>
                        <select class="form-select" id="employeeSelect" name="employee_id">
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </form>
            </div>
        </div>
    </div>
</div>
