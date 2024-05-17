<div class="modal fade" id="addSupplyModal" tabindex="-1" aria-labelledby="addSupplyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSupplyModalLabel">Add New Supply</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('supply.store') }}">
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
                            <label>Amount</label>
                            <input type="text" class="form-control" name="amount" required>
                        </div>
                        <div class="col-md-6">
                            <label>Stock</label>
                            <input type="text" class="form-control" name="stock" required>
                        </div>
                        <div class="col-md-6">
                            <label>Date Acquired:</label>
                            <input type="date" class="form-control" name="date_acquired" required>
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
