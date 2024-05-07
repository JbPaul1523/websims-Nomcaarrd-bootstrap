<div class="modal fade" id="addPrModal" tabindex="-1" aria-labelledby="addPrModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPrLabel">Add New Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('purchaseReport.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Pr Number:</label>
                            <input type="text" class="form-control" name="pr_no" required>
                        </div>
                        <div class="col-md-6">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="name" value="NOMCAARRD">
                        </div>
                        <div class="col-md-6">
                            <label>Purpose:</label>
                            <input type="text" class="form-control" name="description" required>
                        </div>
                        <div class="col-md-6">
                            <label>Category:</label>
                            <select class="form-control" name="category" required>
                                <option value="" disabled selected>Choose the Category</option>
                                @foreach (\App\Models\PurchaseReport::categoryOption() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Choose Equipment:</label><br>
                            @foreach ($equipments as $equip)
                                <input type="checkbox" id="equipment_{{ $equip->id }}" name="equipment_id[]"
                                    value="{{ $equip->id }}">
                                <label for="equipment_{{ $equip->id }}">{{ $equip->name }}</label><br>
                            @endforeach
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
