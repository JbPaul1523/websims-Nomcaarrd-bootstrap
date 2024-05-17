<div class="modal fade" id="show{{ $equipment->id }}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Equipment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label>Name:</label>
                        <p>{{ $equipment->name }}</p>
                    </div>

                    <div class="col-md-6">
                        <label>Description:</label>
                        <p>{{ $equipment->description }}</p>
                    </div>
                    <div class="col-md-6">
                        <label>Serial Number:</label>
                        <p>{{ $equipment->serial_number }}</p>
                    </div>
                    <div class="col-md-6">
                        <label>Amount:</label>
                        <p>{{ $equipment->amount }}</p>
                    </div>
                    <div class="col-md-6">
                        <label>Date Acquired:</label>
                        <p>{{ $equipment->date_acquired }}</p>
                    </div>
                    <div class="col-md-6">
                        <label>Condition:</label>
                        <p>{{ $equipment->condition }}</p>
                    </div>
                    {{-- <div class="col-md-6">
                        <label>Assigned to:</label>
                        <p>{{ $equipment->employee->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <label>Assigned to Category:</label>
                        <p>{{ $equipment->category->name }}</p>
                    </div> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>
