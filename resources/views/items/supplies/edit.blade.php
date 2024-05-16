<div class="modal fade" id="edit{{ $supply->id }}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Supply Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('supply.update', $supply->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $supply->name }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label>Description:</label>
                            <input type="text" class="form-control" name="description"
                                value="{{ $supply->description }}" required>
                        </div>
                        <div class="col-md-6">
                            <label>Amount:</label>
                            <input type="text" class="form-control" name="amount" value="{{ $supply->amount }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label>Stock:</label>
                            <input type="text" class="form-control" name="stock" value="{{ $supply->stock }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label>Date Acquired:</label>
                            <input type="date" class="form-control" name="date_acquired"
                                value="{{ $supply->date_acquired }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fa fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i>
                            Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
