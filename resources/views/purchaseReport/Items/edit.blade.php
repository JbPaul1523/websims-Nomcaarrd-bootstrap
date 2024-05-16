<div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit PR Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('PrItem.update', $item->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $item->name }}"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label>Category</label>
                            <select class="form-control" name="itemcategory" required> <!-- Changed name to "category" -->
                                @foreach (\App\Models\PrItem::getPrItemCategory() as $value => $label)
                                    <option value="{{ $value }}"
                                    {{ $value == $item->itemcategory ?  'selected' : '' }}> {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description"
                                value="{{ $item->description }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="price">Price:</label>
                            <input type="number" step="0.01" class="form-control" name="price"
                                value="{{ $item->price }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="unit">Unit:</label>
                            <input type="text" class="form-control" name="unit" value="{{ $item->unit }}"
                                required>
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