<div class="modal fade" id="show{{ $employee->id }}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Equipment Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label>Name:</label>
                        <p>{{ $employee->name }}</p>
                    </div>
                    <div class="col-md-12">
                        <label>Position</label>
                        <p>{{ $employee->position }}</p>
                    </div>
                    <div class="col-md-12 col-md-offset-1">
                        <table id="mytable" class="table table-bordered table-responsive table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Serial Number</th>
                                <th>Date Aquired</th>
                                <th>Condition</th>
                            </thead>
                            <tbody>
                                @foreach ($employee->equipments as $equipment)
                                    <tr>
                                        <td>{{ $equipment->id }}</td>
                                        <td>{{ $equipment->name }}</td>
                                        <td>{{ $equipment->description }}</td>
                                        <td>{{ $equipment->serial_number }}</td>
                                        <td>{{ $equipment->date_acquired }}</td>
                                        <td>{{ $equipment->condition }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i>
                    Close</button>
            </div>
        </div>
    </div>
</div>
