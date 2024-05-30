<!-- resources/views/items/assets/deduct-form.blade.php -->

<form action="{{ route('assets.deduct', $asset->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="stock" class="form-label">Quantity to Deduct</label>
        <input type="number" name="stock" class="form-control" id="stock" placeholder="Enter quantity" min="1" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description/Purpose</label>
        <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter description or purpose"></textarea>
    </div>
    <button type="submit" class="btn btn-warning"><i class='fa fa-minus'></i> Deduct</button>
</form>
