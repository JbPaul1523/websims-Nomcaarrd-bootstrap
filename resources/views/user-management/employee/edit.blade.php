<div class="modal fade" id="edit{{ $employee->id }}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('employee.update', $employee->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">Employee name</label>
                        <input type="text" name="name" class="form-control" value="{{ $employee->name }}"
                            placeholder="Employee Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="position">Position</label>
                        <input type="text" name="position" class="form-control" value="{{$employee->position}}"  placeholder="Position" required>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                        Cancel</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
