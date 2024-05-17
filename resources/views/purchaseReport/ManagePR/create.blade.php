<div class="modal fade bd-example-modal-lg" id="addPrModal" tabindex="-1" aria-labelledby="addPrModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPrtoryModalLabel">Add New Purchase Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('purchaseReport.store') }}">
                    @csrf
                    <div class="row" id="categorySelect">
                        <div class="col-md-6">
                            <label>Category</label>
                            <select class="form-control" name="condition" required>
                                @foreach (\App\Models\PurchaseReport::getCategory() as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name:</label>
                            <input type="text" class="form-control" name="name"
                                value="CENTRAL MINDANAO UNIVERSITY">
                        </div>
                        <div class="col-md-6">
                            <label>PR No.:</label>
                            <input type="text" class="form-control" name="pr_no" value="">
                        </div>
                        <div class="col-md-6">
                            <label>Fund Cluster:</label>
                            <input type="text" class="form-control" name="fund_cluster" value="7">
                        </div>
                        <div class="col-md-6">
                            <label>Date</label>
                            <input type="date" class="form-control" name="date" required>
                        </div>

                        <div class="col-md-6">
                            <label>purpose</label>
                            <input type="text" class="form-control" name="purpose" value="">
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prItem as $item)
                                    <tr class="item-container">
                                        <td>
                                            <input type="checkbox" id="item_{{ $item->id }}"
                                                name="items[{{ $item->id }}][checked]">
                                        </td>
                                        <td>
                                            <label for="item_{{ $item->id }}">{{ $item->name }}</label>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control quantity-input"
                                                name="items[{{ $item->id }}][quantity]" min="0" disabled>
                                        </td>
                                        <td>
                                            <span class="item-price"
                                                data-price="{{ $item->price }}">P{{ number_format($item->price, 2) }}</span>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control total-cost" readonly>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" style="text-align:right;"><strong>Grand Total:</strong></td>
                                    <td><span id="grand-total">P0.00</span></td>
                                </tr>
                            </tfoot>
                        </table>

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
    @include('purchaseReport.ManagePR.prScript')

</div>
